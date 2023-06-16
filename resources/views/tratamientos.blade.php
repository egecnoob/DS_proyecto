<x-app-layout>
<div class="mx-auto p-4 sm:p-6 lg:p-8">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tratamientos') }}
        </h2>
    </x-slot>

    <!-- Modal Agregar paciente -->
    <div class="modal fade" id="ModalRegistrar" tabindex="-1" aria-labelledby="ModalRegistrarLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="ModalRegistrarLabel">Agregar tratamientos</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <!-- Formulario -->
                                <form action="{{route('tratamiento.create')}}" method="post">
                                    @csrf
                                    <div class="modal-body">

                                    <div class="mb-3">
                                        <label for="CodigoTra" class="form-label">Código</label>
                                        <input type="text" class="form-control" id="CodigoTra" name="txtCodigoTra">
                                    </div>

                                    <div class="mb-3">
                                        <label for="FechaHoraTra" class="form-label">Fecha y Hora</label>
                                        <input type="datetime-local" class="form-control" id="FechaHoraTra" name="txtFechaHoraTra">
                                    </div>

                                    <div class="mb-3">
                                        <label for="DescripcionTra" class="form-label">Descripción</label>
                                        <textarea class="form-control" id="DescripcionTra" name="txtDescripcionTra"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="DosisTra" class="form-label">Dosis</label>
                                        <input type="number" class="form-control" id="DosisTra" name="txtDosisTra" >
                                    </div>

                                    <div class="mb-3">
                                        <label for="FrecuenciaTra" class="form-label">Frecuencia</label>
                                        <input type="number" class="form-control" id="FrecuenciaTra" name="txtFrecuenciaTra" >
                                    </div>

                                    <div class="mb-3">
                                        <label for="DuracionTra" class="form-label">Duración</label>
                                        <input type="number" class="form-control" id="DuracionTra" name="txtDuracionTra"  >
                                    </div>

                                    <div class="mb-3">
                                        <label for="CodigoCon" class="form-label">Código consulta</label>
                                        <select class="form-select" id="CodigoCon" name="txtCodigoCon">
                                        @foreach ($CON as $rows)
                                            <option value="{{ $rows->CodigoCon }}" >{{ $rows->CodigoCon }}</option>
                                        @endforeach
                                        </select>
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
                <th scope="col">Fecha y hora</th>
                <th scope="col">Descripción</th>
                <th scope="col">Dosis</th>
                <th scope="col">Frecuencia</th>
                <th scope="col">Duración</th>
                <th><button class="btn" href="" data-bs-toggle="modal" data-bs-target="#ModalRegistrar">Agregar</button>
                </tr>
            </thead>
            <tbody class="table-group-divider">
            @foreach ($tratamientos as $fila)
                <tr>
                    <td>{{ $fila->CodigoTra }}</td>
                    <td>{{ $fila->FechaHoraTra }}</td>
                    <td>{{ $fila->DescripcionTra }}</td>
                    <td>{{ $fila->DosisTra }}</td>
                    <td>{{ $fila->FrecuenciaTra }}</td>
                    <td>{{ $fila->DuracionTra }}</td>
                    <td>
                        <a class="btn" href="" data-bs-toggle="modal" data-bs-target="#ModalActializar{{ $fila->CodigoTra }}">Actualizar</a>
                        <a class="btn" href="{{route('tratamiento.delete', $fila->CodigoTra)}}" onclick="return res()" >Eliminar</a>
                    </td>

                    <!-- Modal Actualizar paciente -->
                    <div class="modal fade" id="ModalActializar{{ $fila->CodigoTra }}" tabindex="-1" aria-labelledby="ModalActializarLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="ModalActializarLabel">Actualizar tratamientos</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <!-- Formulario -->
                            <form action="{{route('tratamiento.update')}}" method="post">
                                @csrf
                                <div class="modal-body">
                                <div class="mb-3">
                                    <label for="CodigoTra" class="form-label">Codigo</label>
                                    <input type="text" class="form-control" id="CodigoTra" name="txtCodigoTra" value="{{ $fila->CodigoTra }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="CodigoCon" class="form-label">Codigo Consulta</label>
                                    <input type="text" class="form-control" id="CodigoCon" name="txtCodigoCon" value="{{ $fila->CodigoCon }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="FechaHoraTra" class="form-label">Fecha y Hora</label>
                                    <input type="datetime-local" class="form-control" id="FechaHoraTra" name="txtFechaHoraTra" value="{{ $fila->FechaHoraTra }}">
                                </div>

                                <div class="mb-3">
                                    <label for="DescripcionTra" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="DescripcionTra" name="txtDescripcionTra">{{ $fila->DescripcionTra }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="DosisTra" class="form-label">Dosis</label>
                                    <input type="number" class="form-control" id="DosisTra" name="txtDosisTra" value="{{ $fila->DosisTra }}" >
                                </div>

                                <div class="mb-3">
                                    <label for="FrecuenciaTra" class="form-label">Frecuencia</label>
                                    <input type="number" class="form-control" id="FrecuenciaTra" name="txtFrecuenciaTra" value="{{ $fila->FrecuenciaTra }}" >
                                </div>

                                <div class="mb-3">
                                    <label for="DuracionTra" class="form-label">Duración</label>
                                    <input type="number" class="form-control" id="DuracionTra" name="txtDuracionTra" value="{{ $fila->DuracionTra }}" >
                                </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Agregar</button>
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