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
let answered = {};

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
        let data = getData()[count];
        if (!data) {
            return;
        }

        let time = data.question_at;
        if (video.currentTime >= time) {
            video.pause();
            count++;
            updateQuestionData(data);
            myModalEl.show();
        }
    });

    video.addEventListener('ended', (event) => {
        LOADING.page();
        let parameters = {
            'course_id' : courseId,
            'lesson_id' : lessonId,
            'answered' : answered,
        };

        $.post(SUBMIT_ASSIGNMENTS_ROUTE, parameters).done((data) => {
            $('.js-correct-number').html(data.correct);
            $('.js-wrong-number').html(data.wrong);
            $('.js-earned').html(data.earned);

            new Modal(document.getElementById('reward'), {
                backdrop: 'static',
                keyboard: false
            }).show();
        }).always(() => {
            LOADING.unblock();
        });
    });

    $('#send').click(function () {
        //Save answered
        let $listAnswer = $('.answer-options');
        let selected =  $listAnswer.find('input[name="answer"]:checked').val();
        let questionId =  $listAnswer.find('input[name="question_id"]').val();
        answered[questionId] = selected;

        myModalEl.hide();
        video.play();
    });
}

function updateQuestionData(question)
{
    $('.question').html(question.question);

    // create answers
    let answers = question.answers;

    let htmlAnswers = '';
    $.each(answers, function (key, answer) {
        htmlAnswers += '<div class="form-check">';
        htmlAnswers += '<input class="form-check-input" value="' + answer.id + '" type="radio" name="answer" id="answer' + key + '">';
        htmlAnswers += '<label class="form-check-label" for="answer' + key + '">' + answer.answer + '</label>';
        htmlAnswers += '<input type="hidden" name="question_id" value="' + question.id + '"/>';
        htmlAnswers += '</div>';
    });

    $('.answer-options').html(htmlAnswers);
}

function getData()
{
    return videoQuestions;
}
