

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 p-2">Informacion del personal <span class="text-primary"></span></p>

                    </div>
                </div>
                <div class="card-body">
                    <p class="text-uppercase text-sm p-2">Ingrese la Informacion del personal</p>
                    <div class="row">

                        <form action="../php/guardar_personal.php" method="post" enctype="multipart/form-data">

                            <div class="d-flex flex-row justify-content-center">
                                <div class="p-2 col-lg-5">
                                    <label for="edad" class="form-label">DIP</label>
                                    <input type="number" class="form-control" name="dip" id="dip" placeholder="introduce el dip"  >
                                    

                                </div>

                                <div class="p-2 col-lg-5">
                                    <label for="nombre" class="form-label">NOMBRE</label>
                                    <input type="txt" class="form-control" name="nombre" id="nombre" placeholder="introduce el nombre" required>
                                </div>
                            </div>

                            <div class="d-flex flex-row justify-content-center">
                                <div class="p-2 col-lg-5">
                                    <label for="apellidos" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="introduce el apellido" required>
                                </div>

                                <div class="p-2 col-lg-5">
                                    <label for="fecha_nacimiento" class="form-label">FECHA DE NACIMIENTO</label>
                                    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" required>
                                </div>
                            </div>


                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm p-2">Contact Information</p>


                            <div class="d-flex flex-row justify-content-center">
                                <div class=" p-2 col-lg-5">
                                    <label for="telefono" class="form-label">TELEFONO</label>
                                    <input type="text" class="form-control" name="telefono" id="telefono" placeholder="introduce el telefono" required>

                                </div>

                                <div class="p-2 col-lg-5">
                                    <label for="edad" class="form-label">DIRECCION</label>
                                    <input type="text" class="form-control" name="direccion" id="direccion" placeholder="introduce la direccion" required>
                                </div>
                            </div>

                            <div class="d-flex flex-row justify-content-center">
                                <div class="p-2 col-lg-5">
                                    <label for="nacionalidad" class="form-label">NACIONALIDAD</label>
                                    <input type="text" class="form-control" name="nacionalidad" id="nacionalidad" placeholder="introduce la nacionalidad" required>
                                </div>
                                <div class="p-2 col-lg-5">
                                    <label for="sexo">GENERO</label>
                                    <select class="form-control" aria-label=".form-select-lg example" id="genero" name="genero" required>
                                        <option selected>Elije el genero</option>
                                        <option value="M">M</option>
                                        <option value="F">F</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex flex-row justify-content-center">
                                <div class="p-2 col-lg-5">
                                    <label for="edad" class="form-label">EMAIL</label>
                                    <input type="email" class="form-control" name="correo" id="correo" placeholder="introduce el Email" required>
                                </div>
                                <div class="p-2 col-lg-5">
                                    <label for="fecha" class="form-label">FECHA DE REGISTRO</label>
                                    <input type="date" class="form-control" name="fecha" id="fecha" required>


                                </div>
                            </div>


                        <div class="row justify-content-center">
                        <div class="modal-footer col-auto">

                          
                            <a href="../ADMINISTRADOR/personal.php" class="btn btn-danger m-2 btn-sm">Cancelar</a>
                            <button type="submit" class="btn btn-primary m-2 btn-sm"> Guardar </button>

                        </div>

                    </div>



                        </form>
  
                      
                       
                    </div>
                </div>
            </div>