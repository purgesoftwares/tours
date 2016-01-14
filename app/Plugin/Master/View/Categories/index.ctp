<?php
/**
 * Copyright 2010 - 2011, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2011, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<script type="text/javascript">
// <![CDATA[
 $(function(){
	$("a.btn-danger").click(function(e){
		if(confirm('<?php echo __("Are you sure you want to delete this ");?><?php echo $singularize;?>?')){
		$(this).parents('tr.gallerytr').slideUp('slow').remove();
			$.ajax({
				url:$(this).attr('href'),
				success:function(r)
				{
					window.location.reload();
				}
			});
		}
	 	e.preventDefault();
	});
});
//]]>
</script>
<table class="table table-bordered table-striped">
 <thead>
	<tr>
		<th style="background-color: #EEEEEE;">
		<div class="row-fluid">
		   <h1><?php echo $humanize;?>
			   <div class="pull-right">
				 <?php 
					echo $this->Html->link('<i class="icon-plus icon-white"></i>'. __("Add New "). $singularize,array('action'=> 'add',$dropdown_type),array('class'=>'btn btn-primary','escape'=>false));
					?> 
			  </div>
		   </h1>
		</div>
		</th>
	</tr>
	<tr>
		<td>
			<div class="row-fluid">
				<div class="span4">
					<?php  echo $this->element('paging_info'); ?>
				</div>
				<div style="float:right;">
				<?php echo $this->Form->create($model, array('class'=>'form-inline','inputDefaults' => array(
					'label' => false,
					'div' => false
				)));?>
				<?php echo $this->Form->text('name',array('placeholder'=>__('Search By Name'),'class'=>'input-medium')); ?>&nbsp; &nbsp; <?php echo $this->Form->button("<i class='icon-search icon-white'></i>".__("Search"),array('class'=>'btn btn-primary','escape'=>false));?>
						   &nbsp;&nbsp;
				<?php echo $this->Form->end();?>
				</div>
			</div>

          <table width="100%"  class="table table-bordered table-striped" align="center" border="0" cellspacing="0" cellpadding="0">
 
			<tr style="height:30px;">
				<td width="10%" align="left">
					<?php  echo $this->Paginator->sort('name',__('Name'), array('char' => true)); ?>
				</td>
				<td width="18%" align="left">
					<?php  echo $this->Paginator->sort('description',__('Description'),array('char' => true)); ?>
				</td>
				<td width="10%" align="left">
					<?php  echo $this->Paginator->sort('modified',__('	Modified'),array('char'=>true));?>	
				</td>
				<td align="center" width="18%"><center><?php echo __("Action");?></center></td>
		  </tr>
                <?php 
              if( !empty($result) ) {
				
				  $i =  1; 
				
			  		foreach( $result as $records ) { 
			  ?>
              <tr style="height:30px;" class="gallerytr">
				<td  align="left">
					<?php echo $records[$model]['name']; ?>
				</td>
				<td  align="left" style="text-align:justify;">
					<?php echo $this->Text->truncate($records[$model]['description'],50); ?>
				</td>
				
                <td align="left">
					<?php 
						echo date(Configure::read('date_format.basic'),strtotime($records[$model]['modified']));
					 ?>
				</td>
				<td width="15%" align="center">
					<center>
					<!--edit action-->
					  <?php // echo $this->Html->link('Edit', array('plugin' => 'cms', 'controller' => 'pages','action' => 'edit', $records[$model]['id'],$prefix_routing=>true), array('class' => 'btn btn-primary', 'escape' => false) )
					  
					  echo $this->Html->link('<i class="icon-pencil icon-white"></i>'.__("Edit"), array('action' => 'edit', $records[$model]['dropdown_type'],$records[$model]['id']), array('class' => 'btn btn-primary', 'escape' => false) )." ";
					  echo $this->Html->link('<i class="icon-trash icon-white"></i>'.__(" Delete"), array('action' => 'delete',$records[$model]['dropdown_type'],$records[$model]['id']),array('class'=>'btn btn-danger','escape' => false));
					  ?>&nbsp;
					</center>
			    </td>
              </tr>
              <?php
					$i++;
					} ?>
					  <!-- <tr>
						<td align="right" colspan="6" class="border_right">  <?php echo $this->Html->image('dot.gif',array('height'=>10,'width'=>'1'));?> </td>
					 </tr> -->
			</table>
					  <?php echo $this->element('pagination'); ?> 
              <?php } 
			 		else { ?>
               <tr>
                <td align="center" style="text-align:center;" colspan="7" class="border_right"> <?php  echo __("No Result Found ");?></td>
              </tr></table>
              <?php } ?>
        
      </td>
    </tr>
  </thead>
 
</table>