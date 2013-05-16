<?php if (!defined('APPLICATION')) exit();

$PluginInfo['Timeago'] = array(
   'Name'         => 'Timeago',
   'Description'  => 'Timeago adds automatically updating fuzzy timestamps (e.g. "4 minutes ago") throughout Garden.',
   'Version'      => '1.3',
   'Author'       => 'Kasper K. Isager',
   'AuthorEmail'  => 'kasperisager@gmail.com',
   'AuthorUrl'    => 'http://github.com/kasperisager',
   'RequiredApplications' => array('Vanilla' => '2.1a')
);

/**
 * Timeago plugin for Vanilla
 *
 * @since      1.0
 * @author     Kasper Kronborg Isager <kasperisager@gmail.com>
 * @copyright  Copyright © 2013
 * @license    http://opensource.org/licenses/MIT MIT
 */
class Timeago extends Gdn_Plugin
{
   /**
    * Add Timeago throughout Garden
    *
    * @since  1.0
    * @access public
    * @param  object $Sender
    */
   public function Base_Render_Before($Sender)
   {
      $Sender->AddJsFile('jquery.timeago.js', 'plugins/Timeago');

      $Locale = array(
         'PrefixAgo'       => T('TimeAgo-PrefixAgo', NULL),
         'PrefixFromNow'   => T('TimeAgo-PrefixFromNow', NULL),
         'SuffixAgo'       => T('TimeAgo-SuffixAgo', 'ago'),
         'SuffixFromNow'   => T('TimeAgo-SuffixFromNow', 'from now'),
         'Seconds'         => T('TimeAgo-Seconds', 'less than a minute'),
         'Minute'          => T('TimeAgo-Minute', 'about a minute'),
         'Minues'          => T('TimeAgo-Minutes', '%d minutes'),
         'Hour'            => T('TimeAgo-Hour', 'about an hour'),
         'Hours'           => T('TimeAgo-Hours', 'about %d hours'),
         'Day'             => T('TimeAgo-Day', 'a day'),
         'Days'            => T('TimeAgo-Days', '%d days'),
         'Month'           => T('TimeAgo-Month', 'about a month'),
         'Months'          => T('TimeAgo-Months', '%d months'),
         'Year'            => T('TimeAgo-Year', 'about a year'),
         'Years'           => T('TimeAgo-Years', '%d years'),
         'WordSeparator'   => T('TimeAgo-WordSeparator', ' '),
         'Numbers'         => array()
      );

      $Sender->AddDefinition('TimeAgoLocale', json_encode($Locale));

      $Sender->Head->AddString('
<script type="text/javascript">
   jQuery(function() {
      $("time").timeago();
      $("time").livequery(function() {
         $(this).timeago();
      });

      var Locale = $.parseJSON(gdn.definition("TimeAgoLocale"));

      $.timeago.settings.strings = {
         prefixAgo:     Locale.PrefixAgo,
         prefixFromNow: Locale.PrefixFromNow,
         suffixAgo:     Locale.SuffixAgo,
         suffixFromNow: Locale.SuffixFromNow,
         seconds:       Locale.Seconds,
         minute:        Locale.Minute,
         minutes:       Locale.Minutes,
         hour:          Locale.Hour,
         hours:         Locale.Hours,
         day:           Locale.Day,
         days:          Locale.Days,
         month:         Locale.Month,
         months:        Locale.Months,
         year:          Locale.Year,
         years:         Locale.Years,
         wordSeparator: Locale.WordSeparator,
         numbers:       Locale.Numbers
      };
   });
</script>
      ');
   }
}
