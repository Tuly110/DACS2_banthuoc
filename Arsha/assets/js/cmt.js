const append_show_comment = document.querySelector('.show_comments')
const nick_name = document.getElementById('nick_name');
const enter_comment = document.getElementById('nd');
$('#form_cmt').on('submit', function(e){
    alert ("ok");
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'cmt.php?idsp_details=' + $('#idsp_details').val(),
        data: $(this).serializeArray(),
        success:function(data)
        {
            // alert(data);
            res = JSON.parse(data);
            if(res.status ==1)
            {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                    showConfirmButton: false,
                    timer: 1200
                }).then(() => {
                    window.location.reload;
                })
                nd.value='';
            }
            else if(res.status == 2)
            {
                Swal.fire({ 
                    
                    title: 'Bạn chưa đăng nhập',
                    icon: 'warning',
                    // confirmButtonText: "Save",
                    showConfirmButton: false,
                    timer: 1200
                }).then(() => {
                    window.location.href = "details.php?idsp_details=" + $('#idsp_details').val();;
                }) 
                nd.value='';
            }
            else
            {
                Swal.fire({
                    title: 'Bình luận thành công!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1200
                }).then(()=>
                {
                    append_show_comment.innerHTML += `
                    <div class="user_info" style="font-family:Cambria; text-transform: uppercase;">
                        <span class="span_name fw-bold">`+nick_name.value+`</span>
                        <small></small>
                    </div>
                    <div class="user_content my-2">
                        <label style="text-indent: 10px;">`+nd.value+`</label>
                    </div>`;
                    nd.value='';
                })
            }
        }
    })
})