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
        let answerObj = answers[i];
        $('.answer-options').append(
            '<div class="form-check">' +
                '<input class="form-check-input" type="radio" name="answer" id="' + answerObj.id + '">' +
                '<label class="form-check-label" for="' + answerObj.id + '">' + answerObj.answer + '</label>' +
            '</div>'
        );
    }
}

function getData() {

    return VideoQuestions;
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
