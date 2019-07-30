<div class="row">
	<div class="col-md-10 col-xs-12">
		<h2 class="center">Cryptocurrency Market Capitalizations</h2>
	</div>
	<div class="col-md-2 col-xs-12 center">
		<div class="fb-like" data-href="https://www.facebook.com/buythemoon.org/" data-layout="box_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
	</div>
</div>
<br/>

<?php echo $this->element('onlyPaginate'); ?><br/>
	
	<div class="row">
		<?php foreach ($currencies as $currency){ ?>
				<div class="col-md-2 col-xs-6 col-lg-2">
					<div class="thumbnail" style="width: 100%;">
					        
					        <div class="caption center">

					          <?php  echo $this->element('listCurrencyShort',array(
					          		'currency' => $currency,
					          	)); ?>
					          	
					        </div>
		    		</div>	
				</div>
		<?php } ?>
	</div>
	<?php echo $this->element('onlyPaginate'); ?>
<br/>
<div class="row center">
	<div class="alert alert-info" style="font-size: 13px;">
		<strong>
  			Important: Never invest money you can't afford to lose. Always do your own research and due diligence before placing a trade. <!--Read our Terms & Conditions here. -->
  		</strong>
</div>

<!-- Modal -->
  <!--<div class="modal fade" id="myModal" role="dialog" style="color:#0a7394 !important;">
    <div class="modal-dialog">
    
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">How does it work? (Buy the moon - beta)</h4>
        </div>
        <div class="modal-body" >
          <p class="lead tamanioLetraHowItWorks">
          	Hello, let's be honest, there is little accurate information on the internet about whether or not to upload a cryptocurrency in the next few 	hours, with this I am not criticizing any guru.</p>
          <p class="lead tamanioLetraHowItWorks">
          	But social networks are full of trolls saying anything.
          </p>
          <p class="lead tamanioLetraHowItWorks">
          	Buythemoon.org is the solution ?, I think so, at the moment it is in a beta version.
          </p>
          <p class="lead tamanioLetraHowItWorks">
          	The operation is very simple, you vote for what you think will go up in the next twelve hours, by doing so you can see the votes of others.
          </p>
          <p class="lead tamanioLetraHowItWorks">
          	It is true that a user can vote for anyone without doing an analysis and simply vote to see what others think, if the idea of ​​the web like how to solve that problem, is now in beta to see if it has acceptance.
          </p>
          <p class="lead tamanioLetraHowItWorks">
          	<strong>Voting is restarted at 00:00 UTC and 12:00 UTC.</strong>
          </p>
          <p class="lead tamanioLetraHowItWorks">
          	Regards,
          </p>
          <p class="lead tamanioLetraHowItWorks">
          	<strong>buythemoon.org</strong>
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>-->
  
</div>
