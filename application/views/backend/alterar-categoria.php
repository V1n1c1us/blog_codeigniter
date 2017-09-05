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
                                echo form_open('admin/categoria/salvar_alteracoes');// add dados no banco com o método insert no controller

                                foreach($categorias as $categoria)
                                {
                       
                            ?>
                            <div class="form-group">
                               <label id="txt-categoria">Nome da Categoria</label>
                                   <input class="form-control" id="txt-categoria" name="txt-categoria" placeholder="Digite o nome da Categoria" value="<?php echo $categoria->titulo?>">
                            </div>
                            <input type="hidden" name="txt-id" id="txt-id" value="<?php echo $categoria->id?>">
                            <button type="submit" class="btn btn-default">Atualizar</button>
                            <?php
                                }
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
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper


-->

