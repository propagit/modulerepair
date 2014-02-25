<?php $cur_page = $this->uri->segment(1); ?>
<!-- begin header-->
<div class="header-wrap">
    <div class="container">
        <div class="row" >
            <div class="col-lg-12 logo-wrap">
                <a href="<?=base_url();?>"><img class="logo" src="<?=base_url();?>assets/frontend-assets/img/core/logo.png" /></a>
                <span class="slogan">SAVE MONEY, FAST TURNAROUND, FULL WARRANTY</span>
            </div>
        </div>
        <div class="row nav-wrap hidden-xs">
            <div class="col-lg-12">
                <ul class="nav nav-pills">
                	<?php
                	foreach($nav as $n)
					{
						$nurl = '#';
						if($n['page'] != 0)
						{
							$id_title = $this->nav_model->get_page_id_title_by_id($n['page']);
							$nurl = base_url().'page/'.$id_title;
						}
						else 
						{
							if($n['url'] != '')
							{
								$nurl = $n['url'];
							}
						}
						
						$links = $this->nav_model->get_all_links($n['id']);
							?>
                            <li>
                                
                                <?php
                                if($links)
                                {
                                ?>
                                    <a class="dropdown-toggle" <? if($n['id'] == 1) {echo "href='".base_url()."'";}else{echo "href='".$nurl."'";}?> ><?=strtoupper($n['name'])?></a>
                                    <ul class="dropdown-menu desktop-menu">
                                        <li class="ghost-li">&nbsp;</li>
                                        <?php
                                        $ttl = count($links) - 1;
                                        $i = 0;
                                        foreach($links as $l)
                                        {
                                            $url = '#';
                                            if($l['page'] != 0 )
                                            {
                                                $id_title = $this->nav_model->get_page_id_title_by_id($l['page']);
                                                $url = base_url().'page/'.$id_title;
                                                //$url = base_url().'page/'.$l['page'];
                                            }
                                            else
                                            {
                                                $url = $l['url'];
                                            }
                                            
                                            if($ttl == 0)
                                            {
                                                ?>
                                                    <li class="border-top-nav border-left-nav border-right-nav border-bottom-nav">
                                                        <a href="<?=$url?>"><?=$l['name']?></a>
                                                    </li>
                                                <?
                                            }
                                            else
                                            {
                                                if($i == 0)
                                                {
                                                    ?>
                                                        <li class="border-top-nav border-left-nav border-right-nav">
                                                            <a href="<?=$url?>"><?=$l['name']?></a>
                                                        </li>
                                                    <?
                                                }
                                                elseif($i == $ttl)
                                                {
                                                    ?>
                                                        <li class="border-bottom-nav border-left-nav border-right-nav">
                                                            <a href="<?=$url?>"><?=$l['name']?></a>
                                                        </li>
                                                    <?
                                                }
                                                else
                                                {
                                                    ?>
                                                        <li class="border-left-nav border-right-nav">
                                                            <a href="<?=$url?>"><?=$l['name']?></a>
                                                        </li>
                                                    <?
                                                }
                                            }	

                                            $i++;
                                        }
                                        ?>
                                    </ul>
                                <?
                                }
                                else 
                                {
                                ?>
                                    <a <? if($n['id'] == 1) {echo "href='".base_url()."'";}else{echo "href='".$nurl."'";}?> ><?=strtoupper($n['name'])?></a>
                                <?	
                                }
                                ?>
                            </li>
								
							<?
						
						
					
					}
                	?>
                    
                </ul>
            </div>
        </div>
        
        <div class="row nav-wrap visible-xs">
            
            
            <div class="navbar navbar-inverse navbar-fixed-top" id="fixed-top-iphone">
                    <div class="navbar-inner" id="navabar-inner-prop">
                        <div class="container">
                        	<div class="col-lg-12 phone-menu-head">
                                <span class="phone-menu-txt">MENU</span>
                                <button id="fixed-top-button" class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse" type="button">
                                    
                                   <i class="fa fa-align-justify"></i>
                                </button>
                            </div>
                            <div class="phone-menus">
                                <div class="nav-collapse collapse" id="nav-collapse-header" >
                                    <ul class="nav" >
                                     
                                      <?php
                                        foreach($nav as $n)
                                        {
                                            $nurl = '#';
                                            if($n['page'] != 0)
                                            {
                                                $id_title = $this->nav_model->get_page_id_title_by_id($n['page']);
                                                $nurl = base_url().'page/'.$id_title;
                                            }
                                            else 
                                            {
                                                if($n['url'] != '')
                                                {
                                                    $nurl = $n['url'];
                                                }
                                            }
                                            
                                            $links = $this->nav_model->get_all_links($n['id']);
                                                ?>
                                                <li>
                                                    
                                                    <?php
                                                    if($links)
                                                    {
                                                    ?>
                                                        <a data-toggle="dropdown" class="dropdown-toggle a-nav ph_nav_item"  <? if($n['id'] == 1) {echo "href='".base_url()."'";}else{echo "href='".$nurl."'";}?> ><?=strtoupper($n['name'])?> <i class="fa fa-angle-down"></i></a>
                                                        <ul class="dropdown-menu">
                                                            <li class="ghost-li">&nbsp;</li>
                                                            <?php
                                                            $ttl = count($links) - 1;
                                                            $i = 0;
                                                            foreach($links as $l)
                                                            {
                                                                $url = '#';
                                                                if($l['page'] != 0 )
                                                                {
                                                                    $id_title = $this->nav_model->get_page_id_title_by_id($l['page']);
                                                                    $url = base_url().'page/'.$id_title;
                                                                    //$url = base_url().'page/'.$l['page'];
                                                                }
                                                                else
                                                                {
                                                                    $url = $l['url'];
                                                                }
                                                                
                                                                if($ttl == 0)
                                                                {
                                                                    ?>
                                                                        <li class="border-top-nav border-left-nav border-right-nav border-bottom-nav">
                                                                            <a href="<?=$url?>"><?=$l['name']?></a>
                                                                        </li>
                                                                    <?
                                                                }
                                                                else
                                                                {
                                                                    if($i == 0)
                                                                    {
                                                                        ?>
                                                                            <li class="border-top-nav border-left-nav border-right-nav">
                                                                                <a href="<?=$url?>"><?=$l['name']?></a>
                                                                            </li>
                                                                        <?
                                                                    }
                                                                    elseif($i == $ttl)
                                                                    {
                                                                        ?>
                                                                            <li class="border-bottom-nav border-left-nav border-right-nav">
                                                                                <a href="<?=$url?>"><?=$l['name']?></a>
                                                                            </li>
                                                                        <?
                                                                    }
                                                                    else
                                                                    {
                                                                        ?>
                                                                            <li class="border-left-nav border-right-nav">
                                                                                <a href="<?=$url?>"><?=$l['name']?></a>
                                                                            </li>
                                                                        <?
                                                                    }
                                                                }	
                
                                                                $i++;
                                                            }
                                                            ?>
                                                        </ul>
                                                    <?
                                                    }
                                                    else 
                                                    {
                                                    ?>
                                                        <a class="a-nav ph_nav_item" <? if($n['id'] == 1) {echo "href='".base_url()."'";}else{echo "href='".$nurl."'";}?> ><?=strtoupper($n['name'])?></a>
                                                    <?	
                                                    }
                                                    ?>
                                                </li>
                                                    
                                                <?
                                            
                                            
                                        
                                        }
                                        ?>
                                      
                                      
                                      
                                      
                                    </ul>
                                </div> 
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="head-bottom-padding">
                    &nbsp;
                    </div>
            </div>            
            
        </div>
    </div><!-- end header container -->
</div>

<!-- end header-->

