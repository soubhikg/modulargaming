<?php defined('SYSPATH') OR die('No direct script access.');


class Controller_Messages extends Controller_Frontend {

	protected $protected = TRUE;

	public function action_index()
	{
		$this->view = new View_Messages_Index;

		// TODO: Add pagination
		$messages = ORM::factory('Message')
			->where('receiver_id', '=', $this->user->id)
			->find_all();

		$this->view->messages = $messages;
	}

	public function action_create()
	{
		if ($_POST)
		{
			try
			{
				$array = Arr::merge($this->request->post(), array(
					'sender_id' => $this->user->id,
					'time'      => time(),
				));

				$message = ORM::factory('Message')
					->create_message($array, array(
						'receiver_id',
						'subject',
						'text',
						'sender_id',
						'time',
					));

				Hint::success('You have sent a message');
				$this->redirect('messages');
			}
			catch (ORM_Validation_Exception $e)
			{
				Hint::error($e->errors('models'));
			}

		}

		$this->view = new View_Messages_Create;
	}


        /**
         * View users profile
         */
        public function action_view()
        {
                $id = $this->request->param('id');

                $message = ORM::factory('Message', $id);

                if ( ! $message->loaded())
                {
                        throw HTTP_Exception::Factory('404', 'No such message');
                }

		if ( $message->receiver_id != $this->user->id )
		{
			throw HTTP_Exception::Factory('403', 'Message does not belong to you');
		}

                $this->view = new View_Messages_View;
                $this->view->message = $message->as_array();
        }


} // End Messages
