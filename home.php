<?php 
include 'admin/db_connect.php'; 
?>
<style>
#portfolio .img-fluid{
    width: calc(100%);
    height: 30vh;
    z-index: -1;
    position: relative;
    padding: 1em;
}
.event-list{
cursor: pointer;
}
span.hightlight{
    background: yellow;
}
.banner{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 26vh;
        width: calc(30%);
    }
    .banner img{
        width: calc(100%);
        height: calc(100%);
        cursor :pointer;
    }
.event-list{
cursor: pointer;
border: unset;
flex-direction: inherit;
}

.event-list .banner {
    width: calc(40%)
}
.event-list .card-body {
    width: calc(60%)
}
.event-list .banner img {
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    min-height: 50vh;
}
span.hightlight{
    background: yellow;
}
.banner{
   min-height: calc(100%)
}
</style>


        <header class="masthead">
            <div class="container-fluid h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end mb-4 page-title">
                    	<h3 class="text-white">Welcome to <?php echo $_SESSION['system']['name']; ?></h3>
                        <hr class="divider my-4" />

                    <div class="col-md-12 mb-2 justify-content-center">
                    </div>                        
                    </div>
                    
                </div>
            </div>
        </header>
            <div class="container mt-3 pt-2">
                <h4 class="text-center text-white">Upcoming Events</h4>
                <hr class="divider">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>
    <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="car2.jpeg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="car3.jpeg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="car4.jpeg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="car5.jpeg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


                <?php
                $event = $conn->query("SELECT e.*,v.venue FROM events e inner join venue v on v.id=e.venue_id where date_format(e.schedule,'%Y-%m%-d') >= '".date('Y-m-d')."' and e.type = 1 order by unix_timestamp(e.schedule) asc");
                while($row = $event->fetch_assoc()):
                    $trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
                    unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                    $desc = strtr(html_entity_decode($row['description']),$trans);
                    $desc=str_replace(array("<li>","</li>"), array("",","), $desc);
                ?>
          
                
          

                <!-- <br> -->
                <?php endwhile; ?>
                
            </div>


<script>
     $('.read_more').click(function(){
         location.href = "index.php?page=view_event&id="+$(this).attr('data-id')
     })
     $('.banner img').click(function(){
        viewer_modal($(this).attr('src'))
    })
    $('#filter').keyup(function(e){
        var filter = $(this).val()

        $('.card.event-list .filter-txt').each(function(){
            var txto = $(this).html();
            txt = txto
            if((txt.toLowerCase()).includes((filter.toLowerCase())) == true){
                $(this).closest('.card').toggle(true)
            }else{
                $(this).closest('.card').toggle(false)
               
            }
        })
    })
</script>