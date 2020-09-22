<script type="text/javascript" src="{{ asset('front/js/jquery.min.js') }}"></script> 
<script type="text/javascript" src="{{ asset('front/js/jquery.lettering.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/bootstrap.min.js') }}"></script> 
<script type="text/javascript" src="{{ asset('common/js/vue.js') }}"></script> 
<script type="text/javascript" src="{{ asset('front/js/owl.carousel.min.js') }}"></script> 
<script type="text/javascript" src="{{ asset('front/js/jquery.bxslider.js') }}"></script> 
<script type="text/javascript" src="{{ asset('front/js/jquery.flexslider.js') }}"></script> 
<script type="text/javascript" src="{{ asset('front/js/revolution-slider.js') }}"></script> 
<script type="text/javascript" src="{{ asset('front/js/megamenu.js') }}"></script> 
<script type="text/javascript">
  /* <![CDATA[ */   
  var mega_menu = '0';
  /* ]]> */
  </script> 
<script type="text/javascript" src="{{ asset('front/js/mobile-menu.js') }}"></script> 
<script type="text/javascript" src="{{ asset('front/js/jquery-ui.js') }}"></script> 
<script type="text/javascript" src="{{ asset('front/js/main.js') }}"></script> 
<script type="text/javascript" src="{{ asset('front/js/countdown.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/cloud-zoom.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="{{ asset('front/js/howler.core.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/jquery.plugin.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/jquery.countdown.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {
          $('#saveQuiz').hide();
          $('#downloadQuiz').hide();
          $('#passed').hide();
          $('#addInfo').hide();
          $('#failed').hide();
          $('#percentage').hide();
          var title = "{{ $title }}";
          var secs = 0;
          var total = [];
          var quiz = [];
          var level = $('#level').val() + "";
          var items = $('#items').val();
              items = parseInt(items) - 1;
          if(title == "Bible Quiz") {
            var bg = new Howl({src: ["{{ asset('front/sounds/bg.mp3') }}"], autoplay: true, loop: true, volume: 0.5});
          }
          var correct = new Howl({src: ["{{ asset('front/sounds/correct.mp3') }}"]});
          var wrong = new Howl({src: ["{{ asset('front/sounds/buzzer.mp3') }}"]});
          var tick = new Howl({src: ["{{ asset('front/sounds/tick.mp3') }}"]});
          var gameover = new Howl({src: ["{{ asset('front/sounds/gameover.mp3') }}"]});
          var win = new Howl({src: ["{{ asset('front/sounds/win.mp3') }}"]});
          var denied = new Howl({src: ["{{ asset('front/sounds/denied.mp3') }}"]});
          var shortly = new Date(); 
          shortly.setMinutes(shortly.getMinutes() + getInitTime(level, items));
          $('#imageLayout').countdown({until: shortly, compact: true, onExpiry: liftOff, onTick: playTick, layout: $('#imageLayout').html()});
          $(".answer").click(function() {
                var id = $(this).attr('id');
                var res = id.split("-");
                var qid = res[1];
                var answered = $('#answerc' + qid).val() + "";
                if(answered != "yes") {
                    var ans1 = $('#answer' + qid + res[2]).val() + "";
                    var ans2 = $('#answerq' + res[1]).val() + "";
                    var ansClass = 'fa fa-check-circle-o';
                    if(ans1 != ans2) {
                        ansClass = 'fa fa-times-circle';
                        wrong.play();
                    } else {
                        total.push(1);
                        correct.play();
                    }
                    $('#' + id + ' > i').removeClass('fa fa-circle-thin');
                    $('#' + id + ' > i').addClass('fa fa-dot-circle-o');
                    $('.question-' + qid + ' > i').addClass(ansClass);
                    $('.question-' + qid + ' > span.required').hide();
                    $('#answerc' + qid).val('yes');
                    var newAns = qid + "|@@|" + ans1;
                    quiz.push(newAns);
                } else {
                    denied.play();
                    alert("You've answered this question already.");
                    $('#imageLayout').countdown('resume');
                }
                $("#" + id).focus();
                var sum = total.reduce(function(a, b) {
                    return a + b;
                }, 0);
                $("#totScore").val(sum);
                
                if(quiz.length >= items) {
                    tick.unload();
                    $('#imageLayout').countdown('pause');
                    $('#quizModal').modal('show');
                    if(sum >= quiz.length/2) {
                        win.play();
                        var loggedIn = $('#loggedIn').val() + "";
                        $('#passed').show();
                        if(loggedIn == true) {
                            $('#saveQuiz').show();
                        } else {
                            $('#addInfo').show();
                            $('#downloadQuiz').show();
                        }
                        $('#percentage').append('<p>' + sum + ' points out of ' + quiz.length + '</p>');
                        $('#percentage').show();
                    } else {
                        gameover.play();
                        $('#failed').show();
                        $('#downloadQuiz').show();
                    }
                    
                }
          });
          $("#success-signup").fadeTo(5000, 500).slideUp(500, function(){
                $("#success-signup").slideUp(500);
          });
          $("#downloadQuiz").click(function() {
                $.post("{{ url('download/quiz') }}", { quiz: quiz, _token: '{{ csrf_token() }}' }, function(result) {	
    				window.location = result.newrt;
    			});
          });
          $("#saveQuiz").click(function() {
                var level = $('#level').val() + "";
                var category = $('#category').val() + "";
                var itms = $('#itms').val();
                $.post("{{ url('save/quiz') }}", { quiz: quiz, category: category, items: itms, secs: secs, level: level, _token: '{{ csrf_token() }}' }, function(result) {	
    				window.location = result.newrt;
    			});
          });
          $("#resetTest, #resetTest2").click(function() {
                window.location = "{{ route('site') }}";
          });
          $("#search-passage").click(function() {
                var book = $("#book_name").val() + "";
                var chapter = $("#chapter").val() + "";
                var verse = $("#verse").val() + "";
                window.location = "https://onlinestorehouse.com/bible/search?book=" + book + "&chapter=" + chapter + "&verse=" + verse; 
          });
          $("#search-topic").click(function() {
                var id = $("#topic").val() + "";
                window.location = "https://onlinestorehouse.com/bible/search/topic?id=" + id; 
          });
          $("#search-word").click(function() {
                var word = $("#keyword_search").val() + "";
                if(word == "") {
                    alert("You must type any word to search.");
                } else {
                    var wd = word;
                    if(word.indexOf(' ') > -1) {
                        wd = word.split(' ').join('|@@@|');
                    }
                    window.location = "https://onlinestorehouse.com/bible/search/word?word=" + wd;
                }
          });
          $("#choose-items").click(function() {
                var qztype = $("#qztype").val() + "";
                var items = $("#quiz_items").val() + "";
                var qcategory = $("#qcategory").val() + "";
                if (/\s/.test(qcategory)) {
                    qcategory = qcategory.replace(" ", "|@@|");
                }
                window.location = "https://onlinestorehouse.com/bible/quiz/with/items?qztype=" + qztype + "&items=" + items + "&qcategory=" + qcategory;
          });
          $("#demo1 h2, #demo1 h3").lettering().children("span").css({'display':'inline-block', '-webkit-transform':'rotate(-3deg)'});
          $('#btn-pulse, #logo-pulse').addClass('animated pulse infinite');
          $('.bestPlanButton1, .bestPlanButton2, .bestPlanButton3').addClass('animated pulse infinite');
          $('#hurry, #detail-flash').addClass('animated flash infinite');
          $('#book_name').change(function() {
              $('#chapter').empty();
              $('#verse').empty();
              var book = $(this).val() + "";
              $.post("{{ url('get/book/chapter') }}", { book: book, _token: '{{ csrf_token() }}' }, function(result){
                var ccntr = parseInt(result.chapter_count);
                var vcntr = parseInt(result.verse_count);
                var copt = "";
                var vopt = "";
                for(i=1; i <= ccntr; i++) {
                    copt += '<option value="' + i + '">' + i + '</option>';
                }
                for(j=1; j <= vcntr; j++) {
                    vopt += '<option value="' + j + '">' + j + '</option>';
                }
                $('#chapter').append(copt);
                $('#verse').append(vopt);
              });
          });
          $('#chapter').change(function() {
              $('#verse').empty();
              var chapter = $(this).val() + "";
              var book = $('#book_name').val() + "";
              $.post("{{ url('get/book/verse') }}", { book: book, chapter: chapter, _token: '{{ csrf_token() }}' }, function(result){
                var vcntr = parseInt(result.verse_count);
                var vopt = "";
                for(j=1; j <= vcntr; j++) {
                    vopt += '<option value="' + j + '">' + j + '</option>';
                }
                $('#verse').append(vopt);
              });
          });
          $('#timesUp').on('shown.bs.modal', function () {
              gameover.play();
          });
          function liftOff() {
                $('#timesUp').modal('show');
          }
          function playTick(periods) {
              secs = secs + 1;
              tick.play();
          }
          function getInitTime(lvl, itm) {
              if(lvl == "simple") {
                  return itm;
              } else if(lvl == "moderate") {
                  return Math.round(itm/2 + 1);
              } else if(lvl == "hard") {
                  return Math.round(itm/2);
              }
          }
  });
</script>
<script type="text/javascript" src="{{ asset('front/js/site.js') }}"></script>