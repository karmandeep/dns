<div menuitemname="Domain Details Management" class="panel panel-sidebar panel-default panel-actions">
   <div class="panel-heading">
     <h3 class="panel-title">
        <i class="fa fa-gear"></i>&nbsp;Manage
        <i class="fa fa-chevron-up panel-minimise pull-right"></i>
     </h3>
   </div>
   <div class="list-group list-group-tab-nav">
        {if $smarty.get.hosting_id}
        <a menuitemname="Overview" href="/clientarea.php?action=productdetails&amp;id={$smarty.get.hosting_id}#tabOverview" class="list-group-item" id="Primary_Sidebar-Domain_Details_Management-Overview"> Overview </a>
        <a menuitemname="DNS Management" href="/index.php?m=dns&amp;hosting_id={$smarty.get.hosting_id}" class="list-group-item active" id="Primary_Sidebar-Domain_Details_Management-DNS_Management"> DNS Management </a>
        {else}
        <a menuitemname="Overview" href="/clientarea.php?action=domaindetails&amp;id={$id}#tabOverview" class="list-group-item" id="Primary_Sidebar-Domain_Details_Management-Overview"> Overview </a>
        <a menuitemname="DNS Management" href="/index.php?m=dns&amp;id={$id}" class="list-group-item active" id="Primary_Sidebar-Domain_Details_Management-DNS_Management"> DNS Management </a>
   		{/if}
   </div>
</div>
