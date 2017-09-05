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
                    <?php echo 'Adicionar Nova '.$subtitulo?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                                echo validation_errors('<div class="alert alert-danger">','</div>');
                                echo form_open('admin/categoria/insert');// add dados no banco com o método insert no controller
                            ?>
                            <div class="form-group">
                               <label id="txt-categoria">Nome da Categoria</label>
                                   <input class="form-control" id="txt-categoria" name="txt-categoria" placeholder="Digite o nome da Categoria">
                            </div>
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
                                $this->table->set_heading("Nome da Categoria","Alterar","Excluir");
                            foreach ( $categorias as $categoria ){
                                $nomecat= $categoria->titulo;
                                $alterar= anchor(base_url('admin/categoria'),'<i class="fa fa-refresh fa-fw"></i>Alterar');
                                $excluir= anchor(base_url('admin/categoria/excluir/'.md5($categoria->id)),'<i class="fa fa-remove fa-fw"></i>Excluir');

                                $this->table->add_row($nomecat, $alterar, $excluir);
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

