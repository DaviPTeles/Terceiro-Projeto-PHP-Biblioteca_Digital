<?php

switch ($_REQUEST["acao"]) {
    case "cadastrar":

        $idlivro = mysqli_real_escape_string($conn, trim($_POST['idlivro']));
        $usuario = mysqli_real_escape_string($conn, trim($_POST['cpf']));
        $inicio = mysqli_real_escape_string($conn, trim($_POST['inicio']));
        $previsao = mysqli_real_escape_string($conn, trim($_POST['previsão']));
        $status = "pendente";
    
        if (empty($idlivro) || empty($usuario) || empty($inicio) || empty($previsao) || empty($status)) {
            $_SESSION['mensagem'] = 'Preencha todos os campos obrigatórios';
            header('Location: index.php?page=novoemprestimo');
            exit;
        }

        if ($previsao <= $inicio) {
            $_SESSION['mensagem'] = 'A data prevista deve ser posterior à data de início.';
            header('Location: index.php?page=listaremprestimo');
            exit;
        }

        $sqlVerificaDisponibilidade = "SELECT status_id FROM copia_livro WHERE id = '$idlivro' AND status_id = 1 LIMIT 1";
        $resVerificaDisponibilidade = $conn->query($sqlVerificaDisponibilidade);
    
        if ($resVerificaDisponibilidade->num_rows == 0) {
            $_SESSION['mensagem'] = 'O livro não está disponível para empréstimo.';
            header('Location: index.php?page=novoemprestimo');
            exit;
        }
    
        // Inicia a transação
        $conn->begin_transaction();
    
        try {
            // Cadastra o empréstimo
            $sql = "INSERT INTO emprestimo (inicio, dataprevista, status, idlivro, usuario) VALUES ('$inicio', '$previsao', '$status', '$idlivro', '$usuario')";
            $res = $conn->query($sql);
    
            if (!$res) {
                throw new Exception('Erro ao cadastrar o empréstimo: ' . $conn->error);
            }
    
            // Atualiza o status da cópia para emprestada (status_id = 2)
            if ($status == "pendente" || $status == "atrasado") {
                $sql = "UPDATE copia_livro 
                        SET status_id = 2 
                        WHERE id = '$idlivro' 
                        AND status_id = 1 
                        LIMIT 1";
                $res = $conn->query($sql);
    
                if (!$res) {
                    throw new Exception('Erro ao atualizar a disponibilidade da cópia: ' . $conn->error);
                }
    
                // Verifica a quantidade de cópias disponíveis
                $sqlVerificaCopia = "SELECT COUNT(*) as total_copias FROM copia_livro WHERE livro_id = (SELECT livro_id FROM copia_livro WHERE id = '$idlivro') AND status_id = 1";
                $resVerificaCopia = $conn->query($sqlVerificaCopia);
                $row = $resVerificaCopia->fetch_assoc();
    
                $quantidade_copias = $row['total_copias']; // Atribui a quantidade de cópias à variável
    
                if ($quantidade_copias == 0) {
                    // Se não houver cópias disponíveis, atualiza a disponibilidade do livro
                    $sqlAtualizaLivro = "UPDATE livro SET disponibilidade = 'indisponível' WHERE idlivro = (SELECT livro_id FROM copia_livro WHERE id = '$idlivro')";
                    $res = $conn->query($sqlAtualizaLivro);
    
                    if (!$res) {
                        throw new Exception('Erro ao atualizar a disponibilidade do livro: ' . $conn->error);
                    }
                }
    
                // Atualiza a quantidade de cópias no livro
                $sqlAtualizaQuantidade = "UPDATE livro SET quantidade = $quantidade_copias WHERE idlivro = (SELECT livro_id FROM copia_livro WHERE id = '$idlivro')";
                $res = $conn->query($sqlAtualizaQuantidade);
    
                if (!$res) {
                    throw new Exception('Erro ao atualizar a quantidade de cópias do livro: ' . $conn->error);
                }
            } 
            
            // Confirma a transação
            $conn->commit();
            $_SESSION['mensagem'] = 'Empréstimo cadastrado com sucesso';
        } catch (Exception $e) {
            // Desfaz a transação em caso de erro
            $conn->rollback();
            $_SESSION['mensagem'] = $e->getMessage();
        }
    
        header('Location: index.php?page=listaremprestimo');
        exit;
    
        break;

        case "editar":
            $emprestimoid = mysqli_real_escape_string($conn, trim($_POST['id']));
            $idlivro = mysqli_real_escape_string($conn, trim($_POST['idlivro']));
            $usuario = mysqli_real_escape_string($conn, trim($_POST['usuario']));
            $inicio = mysqli_real_escape_string($conn, trim($_POST['inicio']));
            $previsao = mysqli_real_escape_string($conn, trim($_POST['dataprevista']));
            $datareal = mysqli_real_escape_string($conn, trim($_POST['datareal']));
            $status = "pendente";
        
            if (empty($emprestimoid) || empty($idlivro) || empty($usuario) || empty($inicio) || empty($previsao)) {
                $_SESSION['mensagem'] = 'Preencha todos os campos obrigatórios';
                header('Location: index.php?page=editaremprestimo&id=' . $emprestimoid);
                exit;
            }

            if ($previsao <= $inicio) {
                $_SESSION['mensagem'] = 'A data prevista deve ser posterior à data de início.';
                header('Location: index.php?page=editaremprestimo&id=' . $emprestimoid);
                exit;
            }

            if (!empty($datareal) && $datareal < $inicio) {
                $_SESSION['mensagem'] = 'A data real de devolução não pode ser anterior à data de início.';
                header('Location: index.php?page=editaremprestimo&id=' . $emprestimoid);
                exit;
            }
        
            if (!empty($datareal)) {
                if ($datareal > $previsao) {
                    $status = 'concluidocomatraso';
                } else {
                    $status = 'concluído';
                }
            } elseif (strtotime($previsao) < time()) {
                $status = 'atrasado';
            }
        
            // Inicia a transação
            $conn->begin_transaction();
        
            try {
                // Atualiza o empréstimo
                $sql = "UPDATE emprestimo SET inicio = '$inicio', dataprevista = '$previsao', datareal = '$datareal', status = '$status', idlivro = '$idlivro', usuario = '$usuario' WHERE emprestimoid = '$emprestimoid'";
                
                $res = $conn->query($sql);
        
                if (!$res) {
                    throw new Exception('Erro ao atualizar o empréstimo: ' . $conn->error);
                }
        
                // Atualiza o status da cópia para disponível se a data de devolução estiver preenchida
                if (!empty($datareal)) { // Corrigido: use datareal aqui
                    // Atualiza o status da cópia do livro correspondente
                    $sqlAtualizaCopia = "UPDATE copia_livro SET status_id = 1 WHERE id = '$idlivro'";
                    $resCopia = $conn->query($sqlAtualizaCopia);
        
                    if (!$resCopia) {
                        throw new Exception('Erro ao atualizar a disponibilidade da cópia: ' . $conn->error);
                    }
        
                    // Verifica a quantidade de cópias disponíveis
                    $sqlVerificaCopia = "SELECT COUNT(*) as total_copias FROM copia_livro WHERE livro_id = (SELECT livro_id FROM copia_livro WHERE id = '$idlivro') AND status_id = 1";
                    $resVerificaCopia = $conn->query($sqlVerificaCopia);
                    $row = $resVerificaCopia->fetch_assoc();
        
                    $quantidade_copias = $row['total_copias']; // Atribui a quantidade de cópias à variável
        
                    // Atualiza a quantidade de cópias no livro
                    $sqlAtualizaQuantidade = "UPDATE livro SET quantidade = $quantidade_copias WHERE idlivro = (SELECT livro_id FROM copia_livro WHERE id = '$idlivro')";
                    $resQuantidade = $conn->query($sqlAtualizaQuantidade);
        
                    if (!$resQuantidade) {
                        throw new Exception('Erro ao atualizar a quantidade de cópias do livro: ' . $conn->error);
                    }
        
                    // Atualiza a disponibilidade do livro
                    if ($quantidade_copias == 0) {
                        // Se não houver cópias disponíveis, atualiza a disponibilidade do livro
                        $sqlAtualizaLivro = "UPDATE livro SET disponibilidade = 'Indisponível' WHERE idlivro = (SELECT livro_id FROM copia_livro WHERE id = '$idlivro')";
                        $resLivro = $conn->query($sqlAtualizaLivro);
        
                        if (!$resLivro) {
                            throw new Exception('Erro ao atualizar a disponibilidade do livro: ' . $conn->error);
                        }
                    } else {
                        // Se houver cópias disponíveis, define como 'Disponível'
                        $sqlAtualizaLivro = "UPDATE livro SET disponibilidade = 'Disponível' WHERE idlivro = (SELECT livro_id FROM copia_livro WHERE id = '$idlivro')";
                        $resLivro = $conn->query($sqlAtualizaLivro);
        
                        if (!$resLivro) {
                            throw new Exception('Erro ao atualizar a disponibilidade do livro: ' . $conn->error);
                        }
                    }
                }
        
                // Confirma a transação
                $conn->commit();
                $_SESSION['mensagem'] = 'Empréstimo atualizado com sucesso';
            } catch (Exception $e) {
                // Desfaz a transação em caso de erro
                $conn->rollback();
                $_SESSION['mensagem'] = $e->getMessage();
            }
        
            header('Location: index.php?page=listaremprestimo');
            exit;
        
            break;

        case "excluir":
            $emprestimoid = mysqli_real_escape_string($conn, trim($_REQUEST['id']));
            
            if (empty($emprestimoid)) {
                $_SESSION['mensagem'] = 'ID do empréstimo não fornecido';
                header('Location: index.php?page=listaremprestimo');
                exit;
            }
        
            // Inicia a transação
            $conn->begin_transaction();
            
            try {
                // Primeiro, vamos obter o idlivro e o status do empréstimo referente ao empréstimo
                $sql = "SELECT idlivro, status FROM emprestimo WHERE emprestimoid = '$emprestimoid'";
                $result = $conn->query($sql);
                
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_object();
                    $idlivro = $row->idlivro; // Usando idlivro do empréstimo
                    $statusEmprestimo = $row->status;
        
                    // Agora, vamos deletar o empréstimo
                    $sql = "DELETE FROM emprestimo WHERE emprestimoid = '$emprestimoid'";
                    if ($conn->query($sql) === TRUE) {
                        // Se o empréstimo estava pendente ou atrasado, atualiza a cópia do livro
                        if ($statusEmprestimo === 'pendente' || $statusEmprestimo === 'atrasado') {
                            // Obter o livro_id da cópia do livro correspondente ao idlivro
                            $sqlCopia = "SELECT livro_id FROM copia_livro WHERE id = '$idlivro'";
                            $copiaResult = $conn->query($sqlCopia);
                            
                            if ($copiaResult && $copiaResult->num_rows > 0) {
                                $copiaRow = $copiaResult->fetch_object();
                                $livro_id = $copiaRow->livro_id; // livro_id da cópia
                                
                                // Atualiza o status da cópia do livro para disponível
                                $sqlUpdateCopia = "UPDATE copia_livro SET status_id = 1 WHERE id = '$idlivro'"; // 1 é o status 'disponível'
                                if ($conn->query($sqlUpdateCopia) === FALSE) {
                                    throw new Exception('Erro ao atualizar o status da cópia: ' . $conn->error);
                                }
                                
                                // Contar apenas as cópias disponíveis
                                $sqlCountCopia = "SELECT COUNT(*) as total FROM copia_livro WHERE livro_id = '$livro_id' AND status_id = 1"; // 1 para 'disponível'
                                $countResult = $conn->query($sqlCountCopia);
                                if ($countResult && $countResult->num_rows > 0) {
                                    $countRow = $countResult->fetch_assoc();
                                    $quantidade = $countRow['total'];
                                    
                                    // Atualiza a tabela livro com a nova quantidade de cópias disponíveis
                                    $sqlUpdateQuantidade = "UPDATE livro SET quantidade = '$quantidade' WHERE idlivro = '$livro_id'";
                                    if ($conn->query($sqlUpdateQuantidade) === FALSE) {
                                        throw new Exception('Erro ao atualizar a quantidade de cópias do livro: ' . $conn->error);
                                    }
                                    
                                    // Verifica se a quantidade é igual ou maior que 0
                                    if ($quantidade <= 0) {
                                        // Se não há cópias disponíveis, define como 'Indisponível'
                                        $sqlUpdateDisponibilidade = "UPDATE livro SET disponibilidade = 'Indisponível' WHERE idlivro = '$livro_id'";
                                    } else {
                                        // Caso contrário, define como 'Disponível'
                                        $sqlUpdateDisponibilidade = "UPDATE livro SET disponibilidade = 'Disponível' WHERE idlivro = '$livro_id'";
                                    }
                                    
                                    if ($conn->query($sqlUpdateDisponibilidade) === FALSE) {
                                        throw new Exception('Erro ao atualizar a disponibilidade do livro: ' . $conn->error);
                                    }
                                }
                            }
                        }
        
                        // Confirma a transação
                        $conn->commit();
                        $_SESSION['mensagem'] = 'Empréstimo excluído com sucesso';
                    } else {
                        throw new Exception('Erro ao excluir o empréstimo: ' . $conn->error);
                    }
                } else {
                    throw new Exception('Empréstimo não encontrado');
                }
            } catch (Exception $e) {
                // Desfaz a transação em caso de erro
                $conn->rollback();
                $_SESSION['mensagem'] = $e->getMessage();
            }
        
            header('Location: index.php?page=listaremprestimo');
            exit;
            break;
        
}

         $conn->close();
?>