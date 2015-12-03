
<div class="svg-mask carousel slide" id="myCarousel" data-ride="carousel">

     <div class="carousel-inner" role="listbox">
        
<!--         each success story needs represent a new div.item  -->
        <div class="item active">

          <div class="carousel-caption">
              <h3 class="carousel-headline"></h3>
              <p class="carousel-subtext"></p>
          </div>

          <svg width="100%" height="100%" baseProfile="full" version="1.2">
              <defs>
                  <mask id="svgmask2" maskUnits="userSpaceOnUse" maskContentUnits="userSpaceOnUse" transform="scale(1)">
                      <image width="100%" height="100%" xlink:href="app/themes/odfw-ocs-sage/dist/images/or.png" />
                  </mask>
              </defs>        
              <image id="the-mask" mask="url(#svgmask2)" width="100%" height="100%" y="0" x="0" xlink:href="https://upload.wikimedia.org/wikipedia/commons/3/3d/LARGE_elevation.jpg" />
          </svg>

        </div>
<!--         end div.item -->

      <a href="#myCarousel" class="control_next" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      </a>
      <a href="#myCarousel" class="control_prev" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      </a>

</div>

<ol class="carousel-indicators">
   <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
</ol>
