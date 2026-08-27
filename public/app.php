<?php 
// Load wp
include_once('../../../../wp-load.php');

/** @var wpdb $wpdb */
global $wpdb;
//request is ajax
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {

    // Modus 
    if (isset($_POST['modus'])) {
        switch ($_POST['modus']) {
            case 'is_logged_in':
                echo json_encode([
                    'logged_in' => is_user_logged_in()
                ]);
                exit;
                break;
            case 'vote':
                $user_id = !empty($_POST['user_id']) ? $_POST['user_id'] : false;

                if ($user_id) {     
                    $votingIp = $_SERVER['REMOTE_ADDR'];
    
    
                    $sql = "SELECT 
                                id 
                            FROM 
                                {$wpdb->prefix}votes
                            WHERE
                                voting_ip = %s";
                    $query = $wpdb->prepare($sql, $votingIp);
                    $result = $wpdb->get_var($query);

                    // We have a fresh vote
                    if (empty($result)) {
                        $sql = "INSERT INTO {$wpdb->prefix}votes (voting_ip, master) VALUES (%s, %d)";                        
                        $query = $wpdb->prepare($sql, [
                            $votingIp,
                            $user_id
                        ]);
                        $wpdb->query($query);

                        echo json_encode([
                            'exist' => false
                        ]);
                        
                    } else {
                        echo json_encode([
                            'exist' => true
                        ]);
                    }
                }
                exit;
                break;
            
            default:
                die('No entry');
                break;
        }
     }

}