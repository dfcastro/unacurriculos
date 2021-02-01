<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Usuários
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/users">Usuários</a></li>
    <li class="active"><a href="/admin/users/create">Cadastrar</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Novo Usuário</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form id="usersCreate" action="/admin/users/create" role="form" method="post">
          <?php if( $errorMsg != '' ){ ?>
          <div class="alert alert-danger">
              <?php echo htmlspecialchars( $errorMsg, ENT_COMPAT, 'UTF-8', FALSE ); ?>
          </div>
          <?php } ?>
          <div class="box-body">
       
              <span id="msgError"></span>
            <div class="form-group">
              <label for="desperson">Nome</label>
              <input type="text" class="form-control" id="desperson" name="desperson" placeholder="Digite o nome" >
            </div>
            <div class="form-group">
              <label for="nrphone">Telefone</label>
              <input type="tel" class="form-control" id="nrphone" name="nrphone" placeholder="Digite o telefone">
            </div>
            <div class="form-group">
              <label for="idtypeuser">Tipo de usuário</label>
              <select class="form-control" name="idtypeuser">
                  <?php $counter1=-1;  if( isset($typeuser) && ( is_array($typeuser) || $typeuser instanceof Traversable ) && sizeof($typeuser) ) foreach( $typeuser as $key1 => $value1 ){ $counter1++; ?>
                  <option  value="<?php echo htmlspecialchars( $value1["idtypeuser"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo strtoupper($value1["destypeuser"]); ?></option>
                  <?php } ?>
              </select>
          </div>
            <div class="form-group">
              <label for="desemail">E-mail</label>
              <input type="email" class="form-control" id="desemail" name="desemail" placeholder="Digite o e-mail" >
            </div>
            <div class="form-group">
              <label for="despassword">Senha</label>
              <input type="password" class="form-control" id="despassword" name="despassword" placeholder="Digite a senha" required>
            </div>
            <div class="form-group">
              <label for="despasswordConfirm">Confirme sua senha</label>
              <input type="password" class="form-control" id="despassword-confirm" name="despassword-confirm" placeholder="Confirme sua senha" required>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button  type="submit" class="btn btn-success"  >Cadastrar</button>
          </div>         
            <!-- Modal -->
            <div class="modal fade bd-example-modal-sm" id="modalSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mensagem</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body bg-success">
                    Cadastro realizado com sucesso!
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK!</button>
                  </div>
                </div>
              </div>
            </div>
             <!-- FIM Modal -->
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->

