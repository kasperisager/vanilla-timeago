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
         'PrefixAgo'       => T('Timeago-PrefixAgo', NULL),
         'PrefixFromNow'   => T('Timeago-PrefixFromNow', NULL),
         'SuffixAgo'       => T('Timeago-SuffixAgo', 'ago'),
         'SuffixFromNow'   => T('Timeago-SuffixFromNow', 'from now'),
         'Seconds'         => T('Timeago-Seconds', 'less than a minute'),
         'Minute'          => T('Timeago-Minute', 'about a minute'),
         'Minues'          => T('Timeago-Minutes', '%d minutes'),
         'Hour'            => T('Timeago-Hour', 'about an hour'),
         'Hours'           => T('Timeago-Hours', 'about %d hours'),
         'Day'             => T('Timeago-Day', 'a day'),
         'Days'            => T('Timeago-Days', '%d days'),
         'Month'           => T('Timeago-Month', 'about a month'),
         'Months'          => T('Timeago-Months', '%d months'),
         'Year'            => T('Timeago-Year', 'about a year'),
         'Years'           => T('Timeago-Years', '%d years'),
         'WordSeparator'   => T('Timeago-WordSeparator', ' '),
         'Numbers'         => array()
      );

      $Sender->AddDefinition('TimeagoLocale', json_encode($Locale));

      $Sender->Head->AddString('
<script type="text/javascript">
   jQuery(function() {
      $("time").timeago();
      $("time").livequery(function() {
         $(this).timeago();
      });

      var Locale = $.parseJSON(gdn.definition("TimeagoLocale"));

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
