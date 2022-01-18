require('jquery.repeater');
import {Modal} from "bootstrap";

let count = 0;

const video = document.getElementById('learnVideo');

const myModalEl = new Modal(document.getElementById('exercise'), {
    backdrop: 'static',
    keyboard: false
})

$(document).ready(function ($) {

    initRepeater();

    resetRadio();

    videoHandle();
});

function initRepeater() {
    $('.repeater').repeater({
        initEmpty : false,
        show : function () {
            $(this).slideDown();
        },
        hide: function (deleteElement) {
            if (confirm(trans('message.confirm_delete'))) {
                $(this).slideUp(deleteElement);
            }
        },
        isFirstItemUndeletable : true,
        repeaters: [{
            // Specify the jQuery selector for this nested repeater
            selector: '.inner-repeater',
        }],
        ready: function (setIndexes) {
        }
    });
}

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
            var time = data.time;
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
    return [
        {
            'time': 2,
            'question': 'question 1',
            'answers': [
                'answer1', 'answer2', 'answer3', 'answer4'
            ]
        },
        {
            'time': 10,
            'question': 'question 2',
            'answers': [
                'answer1', 'answer2', 'answer3', 'answer4'
            ]
        }
    ]
}
