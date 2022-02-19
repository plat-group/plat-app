require('jquery.repeater');
import {Modal} from "bootstrap";

$(document).ready(function ($) {

    resetRadio();

    videoHandle();

});

/**
 *
 */
function resetRadio()
{
    $(document).on('change', '.js-check-correct', function () {
        if ($(this).prop('checked')) {
            let $this = $(this);
            $(this).closest(".inner-repeater").find('input[type="checkbox"]').prop("checked", false);
            $this.prop('checked', true);
        }
    });
}


let count = 0;

const video = document.getElementById('learnVideo');

const myModalEl = new Modal(document.getElementById('exercise'), {
    backdrop: 'static',
    keyboard: false
})
/**
 *
 */
function videoHandle()
{
    if (!video) {
        return;
    }
    video.addEventListener('timeupdate', (event) => {
        var data = getData()[count];
        if(data) {
            var time = data.question_at;
            if (video.currentTime >= time) {
                video.pause();
                count++;
                updateQuestionData(data);
                myModalEl.show();
            }
        }
    });

    video.addEventListener('ended', (event) => {
        const rewardModalEl = new Modal(document.getElementById('reward'), {
            backdrop: 'static',
            keyboard: false
        });
        rewardModalEl.show();
    });

    $('#send').click(function(){
        myModalEl.hide();
        video.play();
    });
}

function updateQuestionData(question) {
    $('.question').html(question.question);

    // create anwser checkbox
    var answers = question.answers;
    $('.answer-options').html('');
    for(let i = 0; i < answers.length; i++) {
        $('.answer-options').append(
            '<div class="form-check">' +
                '<input class="form-check-input" type="radio" name="answer" id="answer' + i + '">' +
                '<label class="form-check-label" for="answer' + i + '">' + answers[i] + '</label>' +
            '</div>'
        );
    }
}

function getData() {

    return VideoQuestions;
    // return [
    //     {'time': 18, 'question': 'NEAR sử dụng công nghệ đặc biệt gì để gia tăng số lượng giao dịch, khả năng mở rộng?<br>What technology does NEAR use to increase number of transactions and scalability?', 'answers': ['Sharding','Side-chain','Hub']},
    //     {'time': 40, 'question': 'Ai là nhà sáng lập của NEAR protocol<br>(Who is the founder NEAR protocol?)', 'answers': ['Alexander Skidanov','Ilya Polosukhin','Both A and B']},
    //     {'time': 49, 'question': 'NEAR  sử dụng cơ chế đồng thuận nào?<br>Which consensus mechanism does NEAR implement?', 'answers': ['Proof of Stake','Proof of Work','BFT']},
    //     {'time': 61, 'question': 'Vai trò nào đảm bảo duy trì bảo mật hệ thống ?<br>Which role ensures network security?', 'answers': ['Validator','Nominator','Noone']},
    //     {'time': 61, 'question': 'Validators thực hiện nhiệm vụ gì trong NEAR?<br>What do validators do in NEAR?', 'answers': ['Nothing','Staking ','Delegating']},
    //     {'time': 61, 'question': 'Nếu validators gian lận trong hệ thống thì kết quả ra sao?<br>What happens if validators is malacious?', 'answers': ['Có phần thưởng','Mất hết lượng Staking','Sẽ ko dc làm Validators nữa']},
    //     {'time': 67, 'question': 'Người dùng có thể thể staking hay ko?<br>Can normal users staking or not?', 'answers': ['Có','Không']},
    //     {'time': 91, 'question': 'Nhà phát triển ở Ethereum phát triển các Dapp có thể chuyển sang NEAR bằng cách nào?<br>How developer in Ethereum can develop Dapps in NEAR?', 'answers': ['Aurora','Rainbow Bridge','Both A and B']},
    //     {'time': 138, 'question': 'Đăng kí địa chỉ ví của NEAR mainnet như thế nào?<br>How to register near mainnet wallet?', 'answers': ['<tên địa chỉ>.near','<tên địa chỉ>.testnet','<tên địa chỉ>.near-testnet']}
    // ]
    /*return [
        {'time': 18, 'question': 'What technology does NEAR use to increase number of transactions and scalability?', 'answers': ['Sharding','Side-chain','Hub']},
        {'time': 40, 'question': 'Who is the founder NEAR protocol?', 'answers': ['Alexander Skidanov','Ilya Polosukhin','Both A and B']},
        {'time': 49, 'question': 'Which consensus mechanism does NEAR implement?', 'answers': ['Proof of Stake','Proof of Work','BFT']},
        {'time': 61, 'question': 'Which role ensures network security?', 'answers': ['Validator','Nominator','Noone']},
        {'time': 61, 'question': 'What do validators do in NEAR?', 'answers': ['Nothing','Staking ','Delegating']},
        {'time': 61, 'question': 'What happens if validators is malacious?', 'answers': ['Có phần thưởng','Mất hết lượng Staking','Sẽ ko dc làm Validators nữa']},
        {'time': 67, 'question': 'Can normal users staking or not?', 'answers': ['Có','Không']},
        {'time': 91, 'question': 'How developer in Ethereum can develop Dapps in NEAR?', 'answers': ['Aurora','Rainbow Bridge','Both A and B']},
        {'time': 138, 'question': 'How to register near mainnet wallet?', 'answers': ['<tên địa chỉ>.near','<tên địa chỉ>.testnet','<tên địa chỉ>.near-testnet']}
    ]*/
}
