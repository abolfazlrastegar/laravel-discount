
function datepicker(element) {
    $(element[0]).persianDatepicker({
        selectedBefore: !0,
        cellWidth: 52,
        cellHeight: 40,
        fontSize: 13,
        isRTL: 1,
        theme: 'dark',
        onSelect: function () {
            $(element[1]).val($(element[0]).attr("data-gdate"))
        }
    });
}

function success(e) {
    const id = e.getAttribute('id')
    if (id === 'price' || id === 'edit-price') {
        let currency = Intl.NumberFormat('en-US');
        e.value = currency.format(e.value.replace(/[^0-9]/g, ''));
    }
    const element = document.getElementById(e.getAttribute('id'));
    element.classList.remove('border-danger');
    element.classList.add('border-success');
}


function createCodeDiscount(element) {
    const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"
    let discount = '';
    const charactersLength = Math.ceil(characters.length)
    for (let  i = 0;  i < 8; i++ ) {
        discount += characters.charAt(Math.floor(Math.random() * charactersLength))
    }
    const input =  document.getElementById(element)
    input.value = discount.toUpperCase()
    input.classList.add('border-success');
}


function removeDiscount(id, prefix) {
    $.ajax({url:prefix + "/remove/discount/" + id,
        success: function(result){
            if (result.status === 200) {
                swal.fire({
                    icon: 'success',
                    title: "انجام شد",
                    html: result.message,
                    confirmButtonText: "تایید",
                }).then(function () {
                    location.reload();
                });
            }else {
                swal.fire({
                    icon: 'error',
                    title: "انجام نشد",
                    html: result.message,
                    confirmButtonText: "تایید",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}


function statusDiscount(id, status, prefix) {
    $.ajax({url:prefix + "/discount/status?discount_id=" + id + '&status=' + status,
        success: function(result){
            if (result.status === 200) {
                swal.fire({
                    icon: 'success',
                    title: "انجام شد",
                    html: result.message,
                    confirmButtonText: "تایید",
                }).then(function () {
                    location.reload();
                });
            }else {
                swal.fire({
                    icon: 'error',
                    title: "انجام نشد",
                    html: result.message,
                    confirmButtonText: "تایید",
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}

$(document).ready(function() {
    $('form').submit(function (e) {
        e.preventDefault();
        const form = $(this);
        let validation = true
        $('#' + form.attr('id') + ' input').each(function () {
                const input = $(this);
                if (input.val() === '') {
                    validation = false
                    document.getElementById(input.attr('id')).classList.add('border-danger')
                }
            }
        );
        if (validation) {
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                processData: false,
                contentType: false,
                data: new FormData(document.getElementById(form.attr('id'))),
                success: function (data) {
                    if (data.status === 200) {
                        swal.fire({
                            icon: 'success',
                            title: "انجام شد",
                            html: data.message,
                            confirmButtonText: "تایید",
                        }).then(function () {
                            location.reload();
                        });
                    }
                },
                error: function (data) {
                    swal.fire({
                        icon: 'error',
                        title: "توجه",
                        html: data.message,
                        confirmButtonText: "تایید",
                    }).then(function () {
                        location.reload();
                    })
                },
            });
        }

    });
});
