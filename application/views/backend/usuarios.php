<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo 'Administar - '.$subtitulo?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo 'Adicionar Novo '.$subtitulo?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                                echo validation_errors('<div class="alert alert-danger">','</div>');
                                echo form_open('admin/usuarios/insert');// add dados no banco com o método insert no controller
                            ?>
                            <div class="form-group">
                               <label id="txt-nome">Nome do Usuário</label>
                                   <input class="form-control" id="txt-nome" name="txt-nome" 
                                   placeholder="Digite o nome do Usuário" value="<?php echo set_value('txt-nome')?>">
                            </div>
                            <div class="form-group">
                               <label id="txt-email">Email</label>
                                   <input class="form-control" id="txt-email" name="txt-email" 
                                   placeholder="Digite o Email" value="<?php echo set_value('txt-email')?>">
                            </div>
                            <div class="form-group">
                               <label id="txt-historico">Histórico</label>
                               <textarea name="txt-historico" id="txt-historico" class="form-control"><?php echo set_value('txt-historico')?></textarea>
                            </div>
                            <div class="form-group">
                               <label id="txt-user">User</label>
                                   <input class="form-control" id="txt-user" name="txt-user" 
                                   placeholder="Digite o Usuário" value="<?php echo set_value('txt-user')?>">
                            </div>
                            <div class="form-group">
                               <label id="txt-senha">Senha</label>
                                   <input type="password" class="form-control" id="txt-senha" name="txt-senha" 
                                   placeholder="Digite o Email">
                            </div>
                            <div class="form-group">
                               <label id="txt-confir-senha">Confirmar Senha</label>
                                   <input type="password" class="form-control" id="txt-confir-senha" name="txt-confir-senha">                          </div>
                            <button type="submit" class="btn btn-default">Cadastrar</button>
                            <?php
                            echo form_close();
                            ?>

                        </div>

                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo 'Alterar '.$subtitulo?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                                $this->table->set_heading("Foto","Nome do Usuário","Alterar","Excluir");
                            foreach ( $usuarios as $usuario ){
                                $nomeUser = $usuario->nome;
                                $fotoUser = "Foto";
                                $alterar= anchor(base_url('admin/usuarios/alterar/'.md5($usuario->id)),'<i class="fa fa-refresh fa-fw"></i>Alterar');
                                $excluir= anchor(base_url('admin/usuarios/excluir/'.md5($usuario->id)),'<i class="fa fa-remove fa-fw"></i>Excluir');

                                $this->table->add_row($fotoUser, $nomeUser, $alterar, $excluir);
                            }
                            $this->table->set_template(array(
                                'table_open' => '<table class="table table-striped">'
                            ));
                            echo $this->table->generate();
                            ?>
                        </div>

                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper


-->

