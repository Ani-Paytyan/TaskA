<link rel="stylesheet" href="{{ url('css/create.css')}}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ url('js/myValidation.js')}}" type="text/javascript"></script>
<div class="container">
    <a href="{{ 'index'}}"> Հետ գնալ</a>
    <div class="title">Ավելացնել նոր օգտատեր</div>
    <div class="content">
        <p class="error-text error-text-common displayNone"></p>
        <form action="" id="createNewUser" method="post">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Անուն Ազգանուն</span>
                    <input type="text" name="name" class="name forEmptyError" placeholder="Մուտքագրել անուն, ազգանուն">
                </div>
                <div class="input-box">
                    <span class="details">Էլ․ հասցե</span>
                    <input type="text" name="email" class="email forEmptyError" placeholder="Մուտքագրել էլ․հասցե">
                </div>
                <div class="input-box">
                    <span class="details">Հեռախոսահամար</span>
                    <input type="number" name="phone" class="phone forEmptyError" placeholder="Մուտքագրել հեռախոսահամար">
                </div>
                <div class="input-box">
                    <span class="details">Գաղտնաբառ</span>
                    <input type="text" name="password" class="pass forEmptyError" placeholder="Մուտքագրել գաղտնաբառ">
                </div>
                <div class="input-box">
                    <span class="details">Դեր</span>
                    <select class="input-box5 forEmptyError" name="role" id="SubjectsList">
                        <option class="details"  value="">Մուտքագրել դեր</option>
                        <option class="details" value="admin">Admin</option>
                        <option class="details" value="manager">Manager</option>
                        <option class="details" value="user">User</option>
                    </select>
                </div>
                <div class="input-box">
                    <span class="details">Հաստատել գաղտնաբառը</span>
                    <input type="text" class="repeatPass forEmptyError" placeholder="Հաստատել գաղտնաբառը">
                </div>
            </div>
            <div class="gender-details">
                <span class="gender-title">Ոչ ակտիվ / Ակտիվ</span>
                <input type="checkbox" name="active" id="switch" value="8"><label for="switch">Toggle</label>
            </div>
            <div class="button">
                <input type="button" id = "createUser" value="Register">
            </div>
        </form>
    </div>
</div>
<script type="application/javascript">
    $(document).ready(function(){
        var role = '';
        $("#SubjectsList").change(function () {
            role = $("#SubjectsList option:selected").text();
        });

        $("#switch").click(function () {
            if($("#switch").hasClass('on')) {
                $("#switch").removeClass('on');
                $("#switch").val(0);
            } else{
                $("#switch").addClass('on');
                $("#switch").val(1);
            }

        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#createUser").click(function(e) {
            var check = true;
            var symbolMaxCount = 50;
            var phoneSymbolMaxCount = 20;
            var passwordSymbolMaxCount = 64;
            var passwordSymbolMinCount = 8;

            $('.error-text').addClass('displayNone');
            $('.error-text-common').addClass('displayNone');

            // $('.lengthError').addClass('displayNone');
            $('.email').removeClass('error');
            $('.name').removeClass('error');
            $('.pass').removeClass('error');
            $('.error-text-common').addClass('displayNone');
            $('.phone').removeClass('error');
            $("#SubjectsList").removeClass('error');


            let name = $('.name').val();
            let email = $('.email').val();
            let phone = $('.phone').val();
            let pass = $('.pass').val();
            let repeatPass = $('.repeatPass').val();

            if (role.length <1) {
                $("#SubjectsList").addClass('error');
                check = false;
            }

            //empty validation
            let forCheckElementsContainer = document.querySelectorAll('input.forEmptyError');
            $('.emptyError').addClass('displayNone');
            forCheckElementsContainer.forEach(function (element) {
                if(!validateEmpty(element)){
                    if(element.classList.contains('error')) {
                        $('.error-text-common').removeClass('displayNone');
                        $('.error-text-common').text('Լրացնել բոլոր դաշտերը');
                        check = false;
                    }
                    return false;
                }

            },);

            // validation for userName (must be < 50)
            if (!validateLength(name, symbolMaxCount)) {
                $('.name').addClass('error');
                $('.error-text-common').removeClass('displayNone');
                $('.error-text-common').text('Անուն առավելագույն նիշերի քանակը 50 է');
                check = false;

                return false;
            }
            // validation for email length (must be < 50)
            if (!validateLength(email, symbolMaxCount)) {
                $('.error-text-common').removeClass('displayNone');
                $('.error-text-common').text('էլ․հասցե առավելագույն նիշերի քանակը 50 է');
                check = false;
                return false;
            }

            //phone length validation (must be < 20)
            if (!validateLength(phone, phoneSymbolMaxCount)){
                $('.phone').addClass('error');
                $('.error-text-common').removeClass('displayNone');
                $('.error-text-common').text('Հեռախոսահամարի առավելագույն նիշերի քանակը 20 է');
                check = false;

                return false;
            }

            // //email validation
            if (!validateEmail(email)) {
                $('.email').addClass('error');
                $('.error-text-common').removeClass('displayNone');
                $('.error-text-common').text('Էլ․հասցեն ստանդարտներին համապատասխան լրացնել');
                check = false;

                return false;
            }

            //password length validation
            if (!validatePasswordWithRepeatPassword(pass, repeatPass)){
                $('.pass').addClass('error');
                $('.repeatPass').addClass('error');
                $('.error-text-common').removeClass('displayNone');
                $('.error-text-common').text('Գաղտնաբառը և հաստատող գաղտնաբառը տարբեր են');
                check = false;

                return false;
            }

            // password length validation
            if (!validatePassword(pass, passwordSymbolMaxCount, passwordSymbolMinCount)){
                $('.pass').addClass('error');
                $('.error-text-common').removeClass('displayNone');
                $('.error-text-common').text('Գաղտնաբառի առավելագույն նիշերի քանակը 64 է, իսկ նվազագուընը՝ 8');

                return false;
            }
            if (check) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ url('createUser') }}",
                    data: $('#createNewUser').serialize(),
                    success: function(result) {
                        $(location).attr("href", "{{ url('index') }}");
                    },
                    error: function(result) {
                    }
                });
            }
        });
    });

</script>
