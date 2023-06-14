<x-app-layout>
<div class="mx-auto p-4 sm:p-6 lg:p-8">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pacientes') }}
        </h2>
    </x-slot>

    <!-- Modal Agregar paciente -->
    <div class="modal fade" id="ModalRegistrar" tabindex="-1" aria-labelledby="ModalRegistrarLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="ModalRegistrarLabel">Agregar paciente</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <!-- Formulario -->
                                <form action="{{route('paciente.create')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                    @php
                                        $fields = [
                                            ['id' => 'CodigoP', 'label' => 'Codigo', 'name' => 'txtCodigoP'],
                                            ['id' => 'TipoDocP', 'label' => 'Tipo documento', 'name' => 'txtTipoDocP'],
                                            ['id' => 'NroDocP', 'label' => 'Número documento', 'name' => 'txtNroDocP'],
                                            ['id' => 'PaternoP', 'label' => 'Apellido paterno', 'name' => 'txtPaternoP'],
                                            ['id' => 'MaternoP', 'label' => 'Apellido materno', 'name' => 'txtMaternoP'],
                                            ['id' => 'NombresP', 'label' => 'Nombres', 'name' => 'txtNombresP'],
                                            ['id' => 'CelularP', 'label' => 'Celular', 'name' => 'txtCelularP'],
                                        ];
                                    @endphp

                                    @foreach ($fields as $field)
                                        <div class="mb-3">
                                            <label for="{{ $field['id'] }}" class="form-label">{{ $field['label'] }}</label>
                                            <input type="text" class="form-control" id="{{ $field['id'] }}" name="{{ $field['name'] }}">
                                        </div>
                                    @endforeach

                                    <div class="mb-3">
                                        <label for="SexoP" class="form-label">Sexo</label>
                                        <select class="form-select" id="SexoP" name="txtSexoP">
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="FechaNacimientoP" class="form-label">Fecha Nacimiento</label>
                                        <input type="date" class="form-control" id="FechaNacimientoP" name="txtFechaNacimientoP">
                                    </div>
                                    <div class="mb-3">
                                        <label for="EnfermedadesPreviasP" class="form-label">Enfermedades Previas</label>
                                        <textarea class="form-control" id="EnfermedadesPreviasP" name="txtEnfermedadesPreviasP"></textarea>
                                    </div>
                                
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Agregar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
    </div>

    @if (session("correcto"))
        <div class="alert alert-success">{{session("correcto")}}</div>
    @endif

    @if (session("incorrecto"))
        <div class="alert alert-danger">{{session("incorrecto")}}</div>
    @endif

    <script>
        var res=function(){
            var not=confirm("¿Estas seguro de eliminar?");
            return not;
        }
    </script>
    
    <div class="p-5 table table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                <th scope="col">Codigo</th>
                <th scope="col">Tipo documento</th>
                <th scope="col">Número documneto</th>
                <th scope="col">A. paterno</th>
                <th scope="col">A. materno</th>
                <th scope="col">Nombres</th>
                <th scope="col">Enfermedades previas</th>
                <th scope="col">Sexo</th>
                <th scope="col">Celular</th>
                <th scope="col">Fecha nacimiento</th>
                <th><button class="btn" href="" data-bs-toggle="modal" data-bs-target="#ModalRegistrar">Agregar</button>
                </tr>
            </thead>
            <tbody class="table-group-divider">
            @foreach ($pacientes as $fila)
                <tr>
                    <td>{{ $fila->CodigoP }}</td>
                    <td>{{ $fila->TipoDocP }}</td>
                    <td>{{ $fila->NroDocP }}</td>
                    <td>{{ $fila->PaternoP }}</td>
                    <td>{{ $fila->MaternoP }}</td>
                    <td>{{ $fila->NombresP }}</td>
                    <td>{{ $fila->EnfermedadesPreviasP }}</td>
                    <td>{{ $fila->SexoP }}</td>
                    <td>{{ $fila->CelularP }}</td>
                    <td>{{ $fila->FechaNacimientoP }}</td>
                    <td>
                        <a class="btn" href="" data-bs-toggle="modal" data-bs-target="#ModalActializar{{ $fila->CodigoP }}">Actualizar</a>
                        <a class="btn" href="{{route('paciente.delete', $fila->CodigoP)}}" onclick="return res()" >Eliminar</a>
                    </td>

                    <!-- Modal Actualizar paciente -->
                    <div class="modal fade" id="ModalActializar{{ $fila->CodigoP }}" tabindex="-1" aria-labelledby="ModalActializarLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="ModalActializarLabel">Actualizar paciente</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <!-- Formulario -->
                            <form action="{{route('paciente.update')}}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="CodigoP" class="form-label">Codigo</label>
                                    <input type="text" class="form-control" id="CodigoP" name="txtCodigoP" value="{{ $fila->CodigoP }}" readonly>
                                </div>
                                @php
                                    $fields = [
                                        ['id' => 'TipoDocP', 'label' => 'Tipo documento', 'name' => 'txtTipoDocP', 'value' => $fila->TipoDocP],
                                        ['id' => 'NroDocP', 'label' => 'Número documento', 'name' => 'txtNroDocP', 'value' => $fila->NroDocP],
                                        ['id' => 'PaternoP', 'label' => 'Apellido paterno', 'name' => 'txtPaternoP', 'value' => $fila->PaternoP],
                                        ['id' => 'MaternoP', 'label' => 'Apellido materno', 'name' => 'txtMaternoP', 'value' => $fila->MaternoP],
                                        ['id' => 'NombresP', 'label' => 'Nombres', 'name' => 'txtNombresP', 'value' => $fila->NombresP],
                                        ['id' => 'CelularP', 'label' => 'Celular', 'name' => 'txtCelularP', 'value' => $fila->CelularP],
                                    ];
                                @endphp

                                @foreach ($fields as $field)
                                    <div class="mb-3">
                                        <label for="{{ $field['id'] }}" class="form-label">{{ $field['label'] }}</label>
                                        <input type="text" class="form-control" id="{{ $field['id'] }}" name="{{ $field['name'] }}" value="{{ $field['value'] }}">
                                    </div>
                                @endforeach

                                <div class="mb-3">
                                    <label for="SexoP" class="form-label">Sexo</label>
                                    <select class="form-select" id="SexoP" name="txtSexoP">
                                        <option value="Masculino" <?php if ($fila->SexoP == "Masculino") echo "selected"; ?>>Masculino</option>
                                        <option value="Femenino" <?php if ($fila->SexoP == "Femenino") echo "selected"; ?>>Femenino</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="FechaNacimientoP" class="form-label">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" id="FechaNacimientoP" name="txtFechaNacimientoP" value="{{ $fila->FechaNacimientoP }}">
                                </div>
                                <div class="mb-3">
                                    <label for="EnfermedadesPreviasP" class="form-label">Enfermedades Previas</label>
                                    <textarea class="form-control" id="EnfermedadesPreviasP" name="txtEnfermedadesPreviasP">{{ $fila->EnfermedadesPreviasP }}</textarea>
                                </div>
                            
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</div>
</x-app-layout>