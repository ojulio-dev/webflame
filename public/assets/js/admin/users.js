$(document).ready(function() {

    $('.main-modal.-reportedUsers .buttons-wrapper button').click(function() {

        console.log($(this).data('action'));

        if ($(this).data('action') == 'ban') {

            Swal.fire({
                title: 'Banir usuário?',
                text: 'Se possível, escreva o motivo',
                input: 'textarea',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showCancelButton: true,
                confirmButtonText: 'Banir',
                cancelButtonText: 'Cancelar',
                showLoaderOnConfirm: true
              }).then((result) => {

                if (result.isConfirmed) {

                    if (result.isConfirmed) {
                        Swal.fire(
                            'Feito!',
                            'O usuário foi removido da nossa plataforma!',
                            'success'
                        )
                    }

                }

            })

        } else {

            Swal.fire({
                title: 'Certeza?',
                text: "Tem certeza que esse usuário é limpo?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tenho',
                cancelButtonText: 'Não tenho'
              }).then((result) => {
                if (result.isConfirmed) {
                  Swal.fire(
                    'Feito!',
                    'O usuário continuará on-line em nossa plataforma!',
                    'success'
                  )
                }
            })

        }

    });

});