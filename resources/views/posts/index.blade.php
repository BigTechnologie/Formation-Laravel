@extends('base')

@section('title')
    Admin Post
@endsection

@section('container')
    <div class="container">

        <div class="row mt-2">
            <div class="col-md-2">
                <h2>Admin</h2>
            </div>
            <div class="col-md-10">
                <div class="create-btn d-flex justify-content-end my-2">
                    <a href="{{ route('admin.post.create') }}" class="btn btn-primary">Create Post</a>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Ttre</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>
                                    <img src="
                                @if (Str::startsWith($post->imageUrl, 'http'))
                                    {{ $post->imageUrl }}
                                @else
                                    {{ Storage::url($post->imageUrl) }}
                                @endif
                            " height="100" alt="">
                                </td>
                                <td>{{ $post->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('admin.post.view', ['id' => $post->id]) }}" class="btn btn-primary">View</a>
                                    <a href="{{ route('admin.post.edit', ['id' => $post->id]) }}" class="btn btn-warning">Edit</a>
                                    <a href="#" data-title="{{ $post->title }}" data-id="{{ $post->id }}" class="btn btn-danger deleteBtn">delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </thead>
                </table>
                @include('paginate', ['datas' => $posts])
            </div>
        </div>

    </div>

       <div class="modal" id="deleteModal" tabindex="-1"> 
        <div class="modal-dialog modal-dialog-centered"> 
           <div class="modal-content"> 
                <div class="modal-header"> 
                    <h5 class="modal-title">Delete Confirm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                </div>
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> 
                    <button type="button" class="btn btn-primary confirm-delete">Confirm</button> 
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts') 
<script>
   
    document.addEventListener('DOMContentLoaded', function() {
        // Sélectionner tous les boutons avec la classe 'deleteBtn'.
        const deleteBtns = document.querySelectorAll('.deleteBtn');

        const removePost = async (event) => {
         
            event.preventDefault();

            // Récupérer les données id et title à partir des attributs data-id et data-title du bouton cliqué.
            const { id, title } = event.target.dataset;

            // Sélectionner le modal de suppression et les éléments de contenu pertinents.
            const deleteModal = document.getElementById('deleteModal');
            const modalContent = document.querySelector('.modal-body');
            const confirmDelete = document.querySelector('.confirm-delete');

            // Insérer le message de confirmation dans le contenu du modal.
            modalContent.innerHTML = `Êtes-vous sûr de vouloir supprimer ces données: <strong>${title}</strong>?`;
            
            const modal = new bootstrap.Modal(deleteModal);
            modal.show();

            // Définir un gestionnaire d'événement pour le bouton de confirmation de suppression dans le modal.
            confirmDelete.onclick = async (event) => {
                
                const csrf_token = document.head.querySelector('meta[name="csrf-token"]').content;
                try {
                    
                    const response = await fetch("/admin/posts/delete/" + id, {
                        method: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': csrf_token, 
                            'Content-Type': 'application/json'
                        }
                    });

                    // Vérifier si la réponse de la requête est correcte (status HTTP 200-299).
                    if (response.ok) {
                        
                        const result = await response.json();
                        
                        if (result.isSuccess) {
                            modal.hide();
                            window.location.reload();
                        } else {
                           
                            alert(result.message);
                        }
                    } else {
                       
                        alert("Failed to delete the post.");
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            };
        };

        deleteBtns.forEach(deleteBtn => {
            deleteBtn.addEventListener('click', removePost);
        });
    });
</script>
@endsection