$(document).ready(function () {
    var modal = document.getElementById('modalAdd')
    var open = document.getElementById('add_contestant')
    var close = document.getElementById('closeAdd')
    var cancel = document.getElementById('cancelAdd')
    var add = document.getElementById('but_upload')
    var form = document.getElementById('addForm')

    $(open).click(function () {
        modal.style.display = 'block'
        $('#content').css({ width: '50%' })
    })

    $('#addForm').submit(function (e) {
        e.preventDefault()
        var fd = new FormData(this)
        var genderVal = $('input[name="cont_gender"]:checked').val()
        fd.append('genderVal', genderVal)
        console.log(genderVal)

        $.ajax({
            url: 'serverside/addCont.php',
            type: 'POST',
            data: fd,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $('#but_upload').attr('disabled', 'disabled')
                $('#addForm').css('opacity', '.5')
            },
            success: function (response) {
                if (
                    response != 'Sorry, there was an error uploading your data'
                ) {
                    $('#addForm')[0].reset()
                    if (alert(response)) {
                    } else {
                        location.reload()
                    }
                } else {
                    alert(response)
                }

                $('#but_upload').removeAttr('disabled')
                $('#addForm').css('opacity', '0')
            },
        })
    })

    close.onclick = function () {
        modal.style.display = 'none'
        form.reset()
    }
    cancel.onclick = function () {
        modal.style.display = 'none'
        form.reset()
    }
    add.onclick = function () {
        modal.style.display = 'none'
    }
})
