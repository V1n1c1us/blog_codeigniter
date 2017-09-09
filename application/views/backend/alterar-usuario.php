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
                    <?php echo 'Alterar '.$subtitulo?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                                echo validation_errors('<div class="alert alert-danger">','</div>');
                                echo form_open('admin/usuarios/salvar_alteracoes');// add dados no banco com o método insert no controller

                                foreach($usuarios as $usuario){
                            ?>
                            <div class="form-group">
                               <label id="txt-nome">Nome do Usuário</label>
                                   <input class="form-control" id="txt-nome" name="txt-nome" 
                                   placeholder="Digite o nome do Usuário" value="<?php echo $usuario->nome?>">
                            </div>
                            <div class="form-group">
                               <label id="txt-email">Email</label>
                                   <input class="form-control" id="txt-email" name="txt-email" 
                                   placeholder="Digite o Email" value="<?php echo $usuario->email?>">
                            </div>
                            <div class="form-group">
                               <label id="txt-historico">Histórico</label>
                               <textarea name="txt-historico" id="txt-historico" class="form-control"><?php echo $usuario->historico?></textarea>
                            </div>
                            <div class="form-group">
                               <label id="txt-user">User</label>
                                   <input class="form-control" id="txt-user" name="txt-user" 
                                   placeholder="Digite o Usuário" value="<?php echo $usuario->user?>">
                            </div>
                            <div class="form-group">
                               <label id="txt-senha">Senha</label>
                                   <input type="password" class="form-control" id="txt-senha" name="txt-senha" 
                                   placeholder="Digite a Senha">
                            </div>
                            <div class="form-group">
                               <label id="txt-confir-senha">Confirmar Senha</label>
                                   <input type="password" class="form-control" id="txt-confir-senha" name="txt-confir-senha">                          
                            </div>
                            <input type="hidden" name="txt-id" id="txt-id" value="<?php echo $usuario->id?>">
                            <button type="submit" class="btn btn-default">Atualizar</button>
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
                    <?php echo 'Imagem de destaque do '.$subtitulo?>
                </div>
                <div class="panel-body">
                <div class="row" style="padding-bottom: 10px;">
                    <div class="col-lg-3 col-lg-offset-3">
                        <?php 
                            if($usuario->img == 1){
                                echo img("assets/frontend/img/usuarios/".md5($usuario->id).".jpg");
                            }else{
                                echo img("assets/frontend/img/semFoto.jpg");
                            }
                        ?>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-lg-12">
                           <?php

                           $divOpen = '<div class="form-group">';
                           $divClose = '</div>';
                            echo form_open_multipart('admin/usuarios/nova_foto');
                            echo form_hidden('id', md5($usuario->id));
                            echo $divOpen;
                            $imagem = array('name' => 'userfile',
                                                 'id' => 'userfile',
                                                 'class' => 'form-control');
                            echo form_upload($imagem);
                            echo $divClose;
                            echo $divOpen;
                            $botao = array('name' => 'btn_adicionar',
                                                 'id' => 'btn_adicionar',
                                                 'class' => 'btn btn-success',
                                                 'value' => 'Adicionar Nova Imagem');
                            echo form_submit($botao);
                            echo $divClose;
                            echo form_close();
                        }
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

