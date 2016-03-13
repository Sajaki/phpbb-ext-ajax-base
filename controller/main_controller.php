<?php
/**
*
* Ajax Base extension for the phpBB Forum Software package.
*
* @copyright (c) 2015 Jakub Senko <jakubsenko@gmail.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace senky\ajaxbase\controller;

/**
* Main controller
*/
class main_controller
{
	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/**
	* Constructor
	*
	* @param \phpbb\template\template	$template		Template object
	* @param \phpbb\user				$user			User object
	* @param \phpbb\config\config		$config			Config object
	* @param \phpbb\controller\helper	$helper			Helper object
	* @access public
	*/
	public function __construct(\phpbb\template\template $template, \phpbb\user $user, \phpbb\config\config $config, \phpbb\controller\helper $helper)
	{
		$this->template = $template;
		$this->user = $user;
		$this->config = $config;
		$this->helper = $helper;
	}

	/**
	* Handle the Statistics requests
	*
	* @return null
	* @access public
	*/
	public function handle_statistics()
	{
		$this->template->assign_vars(array(
			'TOTAL_POSTS'	=> $this->user->lang('TOTAL_POSTS_COUNT', (int) $this->config['num_posts']),
			'TOTAL_TOPICS'	=> $this->user->lang('TOTAL_TOPICS', (int) $this->config['num_topics']),
			'TOTAL_USERS'	=> $this->user->lang('TOTAL_USERS', (int) $this->config['num_users']),
			'NEWEST_USER'	=> $this->user->lang('NEWEST_USER', get_username_string('full', $this->config['newest_user_id'], $this->config['newest_username'], $this->config['newest_user_colour'], false, $this->helper->route('memberlist'))),
		));

		// Output page
		page_header('');
		$this->template->set_filenames(array(
			'body' => 'ajax_base/statistics.html')
		);
		page_footer();
	}

	/**
	* Handle the Who is online requests
	*
	* @return null
	* @access public
	*/
	public function handle_who_is_online()
	{
		// Output page
		page_header('', true);
		$this->template->set_filenames(array(
			'body' => 'ajax_base/who_is_online.html')
		);
		page_footer();
	}
}
