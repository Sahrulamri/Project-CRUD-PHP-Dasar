// Take the elements are you needs
$(document).ready(function() {
    // event ketika keyword ditulis
    // Menggunakan load
    $('#keyword').on('keyup', function(){
        $('#content').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val())
    });
    // Menggunakan get $.get
    // $.get('ajax/mahasiswa.php?keyword?=' + $('#keyword').val(), function(data) {
    //     $('#content').html(data);
    // })

})




// Add an event when the keyword is typed

// function getOutData(url, success, error) {
//     keyword.addEventListener('keyup', function() {
//         let xhr = new XMLHttpRequest();

//         xhr.onreadystatechange = function() {
//             if (xhr.readyState === 4) {
//                 if(xhr.status === 200) {
//                     success(xhr.responseText);
//                 } else {
//                     error(xhr.responseText);
//                 }
//             }
//         }
//         xhr.open('get', url)
//         xhr.send();
//     })
// }

// function success(s) {
//     console.log(s)
// }

// function error(eror) {
//     console.log(eror);
// }

// getOutData('ajax/coba.txt', success, error);







