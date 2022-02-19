<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ url('css/index.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<h1>Օգտատերերի աղյուսակ</h1>
<div class="table-responsive flexcroll">
    <a class="btn btn-success" href="{{ 'create'}}"> Ավելացնել</a>
    <table class="table table-bordered flexcroll">
        <thead>
            <tr>
                <th>Անուն Ազգանուն</th>
                <th>Էլ․ հասցե</th>
                <th>Հեռախոսահամար</th>
{{--                <th>Գաղտնաբառ</th>--}}
                <th>Ակտիվ</th>
                <th>Դեր</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($userList)):
        foreach ($userList as $user): ?>
        <tr>
            <td><?= $user->name; ?></td>
            <td><?= $user->email; ?></td>
            <td><?= $user->phone; ?></td>
{{--            <td><?= $user->password; ?></td>--}}
            <td><?= $user->active == 1? 'Ակտիվ է' : 'Ակտիվ չէ'; ?></td>
            <td><?= $user->role; ?></td>
            <td>
                <a href="{{'edit/'.$user->id}}" class="btn btn-primary edit" data-id="">Edit</a>
                <a href='' class="btn btn-primary delete" data-id="{{ $user->id }}">Delete</a>
            </td>
        </tr>
        <?php endforeach;
        endif; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".delete").click(function(e) {
            if (confirm("Վստահ եք, որ ցանկանում եք ջնել") == true) {
                var id = $(this).data('id');
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ url('remove') }}",
                    data: {id: id},
                    // data: $('#updateNewUser').serialize(),
                    success: function (result) {
                        $(location).attr("href", "{{ url('index') }}");
                    },
                    error: function (result) {
                    }
                });
            }
        });
    });
</script>
