<table class="table">
     <thead class="table-primary">
         <tr>
             <th>#</th>
             <th>Name</th>
             <th>{{ $clean_up_data[0]->cleanUps[0]->name }}</th>
             <th>{{ $clean_up_data[1]->cleanUps[1]->name }}</th>
             <th>Action</th>
         </tr>
     </thead>
     <tbody>
         @foreach ($clean_up_data as $key => $clean)
             <tr>
                 <td> {{ ++$key }}</td>
                 <td>{{ $clean->name }}</td>
                 <td> {{ $clean->cleanUps[0]->price }}</td>
                 <td> {{ $clean->cleanUps[1]->price }}</td>
                 <td>
                    <button data-bs-toggle="modal" data-title="Edit CleanUp" data-bs-target="#modal-opener" data-url="{{ route('admin.generalsettings.lawnmoving.edit-lawn-cleanup', ['id' => $clean->id]) }}" class="btn btn-success">Edit</button>
                 </td>
             </tr>
         @endforeach()
     </tbody>

 </table>
