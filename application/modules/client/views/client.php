<link href="<?=base_url()?>assets/frontend-assets/template/css/table.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/frontend-assets/tablelist/js/function.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/frontend-assets/template/js/plugins/forms/jquery.select2.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/frontend-assets/template/js/plugins/forms/jquery.uniform.js"></script>


<script type="text/javascript" src="<?=base_url()?>assets/frontend-assets/template/js/plugins/tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/frontend-assets/template/js/plugins/tables/jquery.sortable.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/frontend-assets/template/js/plugins/tables/jquery.resizable.js"></script>

<script>
var $j = jQuery.noConflict();
</script>

<div class="container margin-top-10">
    <div class="wrap page-wrap">
        <!-- Content begins -->
        
        <div class="row">
            <div class="col-lg-12">
                <div class="col-md-12">
                     <span class="page-title">CLIENT PORTAL</span>
                 </div>
            </div>
        </div>        
        <div class="row margin-top-30">
            <div class="col-lg-12">
                <div class="col-sm-8 secondary-pages">
                     <h1>WAVE1 SUPPORT DOCUMENTATION</h1>
                     <h2>FIND A COLLECTION OF RELEVANT DOCUMENTATION <BR> ABOUT OUR PRODUCTS</h2>
                 </div>
                 <div class="col-sm-4">
                    <p style="text-align:right;margin-top:-13px!important;" class="hidden-xs">
                     LOGED IN AS: <span style="cursor: pointer" onclick="window.location='<?=base_url()?>client/edit'" class="red"><?=$customer['firstname']?> <?=$customer['lastname']?></span>
                     <BR>
                     <a href="<?=base_url()?>client/sign_out"><span class="red"><i class="fa fa-unlock"></i> SIGN OUT</span></a>
                    </p>
                    
                    <p style="text-align:left;margin-top:0px!important;" class="visible-xs">
                     LOGED IN AS: <span style="cursor: pointer" onclick="window.location='<?=base_url()?>client/edit'" class="red"><?=$customer['firstname']?> <?=$customer['lastname']?></span>
                     <BR>
                     <a href="<?=base_url()?>client/sign_out"><span class="red"><i class="fa fa-unlock"></i> SIGN OUT</span></a>
                    </p>
                 </div>
             </div>
        </div>             
        <!-- Table List START -->
        <div id="content">            
            <!-- Main content -->
            <div class="wrapper">                            
                <!-- Table with hidden toolbar -->
                <div class="widget">
                    <div class="whead"><h6>DOCUMENT DOWNLOAD</h6></div>
                    <div id="dyn" class="hiddenpars">
                        <a class="tOptions" title="Options"><i class="fa fa-cogs fa-4 black" style="font-size:23px;"></i></a>
                        <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dynamic">
                        <thead>
                            <tr>
                            <th>DOCUMENT TITLE <i class="fa fa-sort-alpha-asc red" ></i><span class="sorting" style="display: block;"></span></th>
                            <th>FILE NAME <i class="fa fa-sort-alpha-asc red"></i><span class="sorting" style="display: block;"></span></th>
                            <th style="text-align:center;">FILE SIZE <i class="fa fa-sort-alpha-asc red"></i><span class="sorting" style="display: block;"></span></th>
                            <th style="text-align:center;">DOWNLOAD</th>
                            </tr>
                        </thead>
                        <tbody>
                        <? foreach($files as $file){
                            
                            ?>
                                <tr class="gradeA">
                                    <td><?=strtoupper($file['name'])?></td>
                                    <td><a target="_blank" href="<?=base_url()?>uploads/files/<?=$file['url']?>"><span class="red"><i class="fa fa-file"></i> <?=$file['url']?></span></a></td>
                                    <td style="text-align:center;"><?=$file['size']?> KB</td>
                                    <td class="center" style="text-align:center;"><a target="_blank" href="<?=base_url()?>uploads/files/<?=$file['url']?>"><i class="fa fa-download red"></i></a></td>
                                </tr>
                            
                            <?	
                        }
                        ?>                       
                        </tbody>
                        </table> 
                    </div>
                </div>             
            </div>
            <!-- Main content ends -->            
        </div>        
        <!-- Table List END -->      
        
        <!-- Content ends -->         
    </div>
</div>