<?php

#[\AllowDynamicProperties]
class MY_Session extends CI_Session {
    // public function destroy($session_id)
    // {
    //     if ($this->CI->input->is_ajax_request()){
    //         return;
    //     }
    //     return parent::destroy($session_id);
    // }
    // public function sess_destroy()
    // {
    //     if ($this->CI->input->is_ajax_request()){
    //         return;
    //     }
    //     return parent::sess_destroy();
    // }
    // public function _cookie_destroy()
    // {
    //     if ($this->CI->input->is_ajax_request()){
    //         return;
    //     }
    //     return parent::_cookie_destroy();
    // }
    
    // public function write($session_id, $session_data)
    // {
    //     if ($this->CI->input->is_ajax_request()){
    //         return;
    //     }

    //     // We only update the session every five minutes by default
    //     if (($this->userdata['__ci_last_regenerate'] + $this->sess_time_to_update) >= $this->now)
    //     {
    //         return;
    //     }
        
    //     return parent::write($session_id, $session_data);
    // }

    // public function sess_regenerate($destroy = FALSE)
    // {
    //     if ($this->CI->input->is_ajax_request()){
    //         return;
    //     }

    //     // We only update the session every five minutes by default
    //     if (($this->userdata['__ci_last_regenerate'] + $this->sess_time_to_update) >= $this->now)
    //     {
    //         return;
    //     }
        
    //     return parent::sess_regenerate($destroy = FALSE);
    // }
}
