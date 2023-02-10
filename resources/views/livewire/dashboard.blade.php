<div>
   
       <h1> i'am a dashboard</h1>
</div>
@push('scripts')
    <script>
        window.addEventListener('close-model', event => {
            $('#modal-basic').modal('hide');
            $('#edit-modal').modal('hide');
            $('#modal-info-delete').modal('hide');
        });


        window.addEventListener('add', event =>{
             Swal.fire(
                  'Super!',
                  'Vous avez ajouter un nouveau projet!',
                'success'
)
        });
    </script>
@endpush
