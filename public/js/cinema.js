let accessSubmitScore = false;
let selectedScore = '';


const message = document.getElementById('message');
const counter = document.getElementById('message-counter');

message.addEventListener('input', () => {
  const count = message.value.length;

  counter.innerHTML = count;

  if (count >= 500) {
    counter.classList.add('text-red-500');
  } else {
    counter.classList.remove('text-red-500');
  }
});


function selectScore(element, score) {
    accessSubmitScore = true;
    selectedScore = score;
    $(".bg-slate-100").each(function () {
        $(this).removeClass("bg-slate-100");
    });

    element.classList.add('bg-slate-100');
}

$('#submit-score-btn').on('click', (event) => {
    if (accessSubmitScore && selectedScore) {
        $.ajax({
            url: $('#url').val(),
            type: "POST",
            dataType: "json",
            data: {
                '_token': $('input[name="_token"]').val(),
                'cinema_id': $('#cinema_id').val(),
                'score': selectedScore
            },
            success: (data) => {
                $('#score').html(data.totalScore)
                Swal.fire({
                    title: 'عملیات موفق !',
                    text: data.message,
                    icon: 'success',
                    confirmButtonText: 'بستن'
                });
            },
            error: (xhr, status, err) => {
                Swal.fire({
                    title: 'خطا !',
                    text: xhr.responseJSON.message,
                    icon: 'error',
                    confirmButtonText: 'بستن'
                })
            },
            complete: () => {

            }
        })
    }
    else {
        Swal.fire({
            title: 'خطا !',
            text: 'لطفا امتیاز را مشخص نمایید',
            icon: 'error',
            confirmButtonText: 'بستن'
        })
    }
});