<!doctype html>
<html lang="en">
  <head>
    <title>Share Product</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="refresh" content="5; url=worldbestprice://prdouct?id={{ $id }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body dir="rtl">

    <div class="container">
        <div class="row">
            <div class="col-12 pt-4">
                <div class="card text-center  bg-info  text-white bg-pink">
                  <div class="card-body">
                    <h4 class="card-title">سيتم تحويلك لصفحة المنتج بالتطبيق، خلال خمس ثوانٍ ...</h4>
                    <p class="card-text">
                        <span>إذا لم يتم تحويلك بشكل تلقائي قم بالضغط</span>
                        <a id="intent" class="intent" data-scheme="worldbestprice://prdouct/{{ $id }}"
                            href="worldbestprice://prdouct?id={{ $id }}"> هنا </a>
                    </p>
                  </div>
                </div>
            </div>
        </div>
    </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        (function () {

            // tries to execute the uri:scheme
            function goToUri(uri, href) {
                var start, end, elapsed;

                // start a timer
                start = new Date().getTime();

                // attempt to redirect to the uri:scheme
                // the lovely thing about javascript is that it's single threadded.
                // if this WORKS, it'll stutter for a split second, causing the timer to be off
                document.location = uri;

                // end timer
                end = new Date().getTime();

                elapsed = (end - start);

                // if there's no elapsed time, then the scheme didn't fire, and we head to the url.
                if (elapsed < 1) {
                    document.location = href;
                }
            }

            $('a.intent').on('click', function (event) {
                goToUri($(this).data('scheme'), $(this).attr('href'));
                event.preventDefault();
            });

            setTimeout(()=>{
                let selector = 'a#intent';
                goToUri($(selector).data('scheme'), $(selector).attr('href'));
            },5000)
        })();
    </script>
    </body>
</html>