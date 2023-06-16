<x-app-layout>
<div class="mx-auto p-4 sm:p-6 lg:p-8">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Citas') }}
        </h2>
    </x-slot>

    <!-- Modal Agregar paciente -->
    <div class="modal fade" id="ModalRegistrar" tabindex="-1" aria-labelledby="ModalRegistrarLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="ModalRegistrarLabel">Agregar cita</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <!-- Formulario -->
                                <form action="{{route('cita.create')}}" method="post">
                                    @csrf
                                    <div class="modal-body">

                                    <div class="mb-3">
                                        <label for="CodigoC" class="form-label">Código</label>
                                        <input type="text" class="form-control" id="CodigoC" name="txtCodigoC">
                                    </div>

                                    <div class="mb-3">
                                        <label for="MotivoC" class="form-label">Motivo</label>
                                        <textarea class="form-control" id="MotivoC" name="txtMotivoC"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="FechaHoraC" class="form-label">Fecha y Hora</label>
                                        <input type="datetime-local" class="form-control" id="FechaHoraC" name="txtFechaHoraC">
                                    </div>

                                    <div class="mb-3">
                                        <label for="CodigoP" class="form-label">Código paciente</label>
                                        <select class="form-select" id="CodigoP" name="txtCodigoP">
                                        @foreach ($pacientes as $rows)
                                            <option value="{{ $rows->CodigoP }}" >{{ $rows->CodigoP }}</option>
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
                <th scope="col">Motivo</th>
                <th scope="col">Paciente</th>
                <th><button class="btn" href="" data-bs-toggle="modal" data-bs-target="#ModalRegistrar">Agregar</button>
                </tr>
            </thead>
            <tbody class="table-group-divider">
            @foreach ($citas as $fila)
                <tr>
                    <td>{{ $fila->CodigoC }}</td>
                    <td>{{ $fila->FechaHoraC }}</td>
                    <td>{{ $fila->MotivoC }}</td>
                    <td>{{ $fila->CodigoP }}</td>
                    <td>
                        <a class="btn" href="" data-bs-toggle="modal" data-bs-target="#ModalActializar{{ $fila->CodigoC }}">Actualizar</a>
                        <a class="btn" href="{{route('cita.delete', $fila->CodigoC)}}" onclick="return res()" >Eliminar</a>
                    </td>

                    <!-- Modal Actualizar paciente -->
                    <div class="modal fade" id="ModalActializar{{ $fila->CodigoC }}" tabindex="-1" aria-labelledby="ModalActializarLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="ModalActializarLabel">Actualizar paciente</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <!-- Formulario -->
                            <form action="{{route('cita.update')}}" method="post">
                                @csrf
                                <div class="modal-body">
                                <div class="mb-3">
                                    <label for="CodigoC" class="form-label">Codigo</label>
                                    <input type="text" class="form-control" id="CodigoC" name="txtCodigoC" value="{{ $fila->CodigoC }}" readonly>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="CodigoP" class="form-label">Código paciente</label>
                                    <input type="text" class="form-control" id="CodigoP" name="txtCodigoP" value="{{ $fila->CodigoP }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="MotivoC" class="form-label">Motivo</label>
                                    <textarea class="form-control" id="MotivoC" name="txtMotivoC">{{ $fila->MotivoC }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="FechaHoraC" class="form-label">Fecha y Hora</label>
                                    <input type="datetime-local" class="form-control" id="FechaHoraC" name="txtFechaHoraC" value="{{ $fila->FechaHoraC }}">
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