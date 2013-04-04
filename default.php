<?php if (!defined('APPLICATION')) exit();

$PluginInfo['Timeago'] = array(
   'Name'         => 'Timeago',
   'Description'  => 'Timeago adds automatically updating fuzzy timestamps (e.g. "4 minutes ago") throughout Garden.',
   'Version'      => '1.2',
   'Author'       => 'Kasper K. Isager',
   'AuthorEmail'  => 'kasperisager@gmail.com',
   'AuthorUrl'    => 'http://github.com/kasperisager',
   'RequiredApplications' => array('Vanilla' => '2.1a')
);

/**
 * Timeago plugin for Vanilla
 *
 * @package    Addons
 * @version    1.2
 * @author     Kasper Kronborg Isager <kasperisager@gmail.com>
 * @copyright  Copyright © 2013
 * @license    http://opensource.org/licenses/MIT MIT
 */
class Timeago extends Gdn_Plugin
{
   /**
    * Add Timeago throughout Garden
    * 
    * @param  Gdn_Controller $Sender
    * @since  1.0
    * @access public
    */
   public function Base_Render_Before($Sender)
   {
      $Sender->AddJsFile('jquery.timeago.js', 'plugins/Timeago');
      
      $Sender->Head->AddString('
<script type="text/javascript">
   jQuery(function() {
      $("time").timeago();
      $("time").livequery(function() {
         $(this).timeago();
      });
   });
</script>
      ');
   }  
}