<!doctype html>
<html lang="ar" moznomarginboxes mozdisallowselectionprint>
    <head>
	<meta charset="UTF-8">
	<title>طباعة فاتورة</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap-rtl.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<style>
        .userinvoice td{
	    border:1px solid #cfcfcf;
        }

	.userinvoice
	{
	    border:1px solid #ccc;
	    line-height: 35px;
	    font-size: 13px;
	    font-family: Arial;
	    background-color: #fff;
	    overflow: hidden;
	}

	.userinvoice .note
	{
	    font-weight: bold;

	}

	.userinvoice .withdraw-N .note
	{
	    color: #003399;
	}
	
	table.userinvoice{
	    width: 95vw;
	    margin: auto;
	}
	
	.no-border, .no-border td{
	    border:0px none transparent;
	}
	.no-border td
	{
	    padding-bottom: 15px;
	}
	
	.user-data .text-muted
	{
	    display: inline-block;
	    min-width: 100px;
	}
	
	@media print {
    	@page 
    	{
    	    size: auto;   /* auto is the initial value */
	    margin: 0mm 0mm 0mm 0mm;  /* this affects the margin in the printer settings */
	}
	}
</style>
    </head>
    <body>
<br />
<br />

<table class="userinvoice no-border">
    <tr>
	<td class="col-md-6 text-center"><img src="<?=base_url()?>assets/img/logo-pic/logo.png" class="img-responsive" /></td>
	<td class="col-md-3">&nbsp;</td>
	<td class="col-md-3 user-data">
	    <p><span class="text-muted">المستخدم </span> <?=$row->username?></p>
	    <p><span class="text-muted">تاريخ الطباعة </span> <?=date('Y-m-d')?></p>
	</td>
    </tr>
</table>
<?php echo $this->shop->userInvoice_table($id, false); ?>
<table class="userinvoice no-border">
<tr><td><br /><hr /><p class="text-center">جميع الحقوق محفوظة لمتجر جوكا &copy;</p></td></tr></table>
<script type="text/javascript">window.print();</script>
	    
    </body>
</html>