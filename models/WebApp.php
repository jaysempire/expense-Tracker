<?php
   #   Author of the script
   #   Name: Jeremiah Achanya
   #   Email: jeremiahachanya@gmail.com
   #   Date created: 31/07/2025
   #   Date modified: 06/08/2025   

	//include_once( 'App.php' );

	class WebApp
	{
		// use App;

		function fixUrl( $page ) 
		{
			$page = strtolower( $page ?? '' );
			return str_replace( '-', '_', $page );
		}

		function showAlert( $msg , $top = false )
		{
			if ( $top ) 
			{
		   	$mt = 'mt-2';

	        if ( isset( $_SESSION['msg'] ) ) 
	        {
	        	$msg = $_SESSION['msg'];
	         	unset( $_SESSION['msg'] );
	        }
  
	        return "<div id='main-msg' class='$mt'> $msg </div>";
			}
			else if ( isset( $msg ) ) 
		   {
            return $msg;
			}
		}
		
		function showAlertMsg( $type, $msg )
		{
			$icon_type  = '';

			if ( $type == 'success' ) 
			{
				$icon_type = "bi bi-check-circle";
			} 
			else if( $type == 'info' ) 
			{
				$icon_type = "bi bi-exclamation-circle";
			}
			else if( $type == 'danger' ) 
			{
				$icon_type = "bi bi-exclamation-octagon";
			}

			$type = "alert-$type";
			$alert = "<div class='alert $type alert-dismissible fade show mt-4' role='alert'><i class='$icon_type me-1'></i> $msg <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
		      </div>";

		   return $alert;
		}
		
		// persist user input
		function persistData( $data, $update = false, $clear = false ) 
		{
			$dt = '';

			if ( $clear ) 
			{
				return $dt;
			}
			
			if ( isset( $_POST[ $data ] ) ) 
			{
				$dt = $_POST[ $data ];
			}
			else 
			{
				if ( $update )
				{
					$dt = $data;
				}
			}

			return $dt;
		}

		// persist Checkbox
		function persistCheckbox( $data, $clear = false ) 
		{
			$dt = '';

			if ( $clear ) 
			{
				return $dt;
			}
			
			if ( isset( $_POST[ $data ] ) ) 
			{
				$dt = 'checked';
			}

			return $dt;
		}

		function createOptions( array $data_arr, $sel_id )
      {
      	$options = ''; 

      	foreach ( $data_arr as $dt )
         {
				$sel = $sel_id == $dt ? 'selected' : '';
				$options .= "<option value='$dt' $sel >$dt</option>";
         }

         return $options;
      }

      function createOptions_2( array $data_arr, $sel_id )
      {
      	$options = ''; 

      	foreach ( $data_arr as $key => $dt ) 
         {
            $sel = $sel_id == $key ? 'selected' : '';
			$options .= "<option value='$key' $sel >$dt</option>";
         }

         return $options;
      }

		function createOptions_3( array $data_arr, $sel_id )
      {
      	$options = ''; 

      	foreach ( $data_arr as $key => $dt ) 
         {
				$sel = $sel_id == $key ? 'selected' : '';
				$options .= "<option value='$key' $sel >$dt</option>";
         }

         return $options;
      }

		function fullName( array $data )
		{
			$middle_name = $data[ 'middle_name' ] ?? '';
			return $data[ 'first_name' ] . " $middle_name " . $data[ 'last_name' ];
		}

		function logout()
		{
			//clearing all 
			$_SESSION = [];
			$_COOKIE = [];
			
			session_destroy(); 
			setcookie( APP_SESS, '', time() - APP_SESS_TIME );	
		}

        function getName(){
            
            $user_name = $_SESSION['user_name'];

            return $user_name;
        }

		function playerDetailsCard($player, $upload_url){
			$is_show = $player['id'] == 1 ? 'show' : '';
            if ($player['status'] == 1){
                $btn_outline = 'btn-outline-danger';
                $word = 'Deactivate';
                $badge = 'Active';
                $badge_color = 'bg-success';
            }
            else{
                $btn_outline = 'btn-outline-success';
                $word = 'Activate';
                $badge = 'Inactive';
                $badge_color = 'bg-danger';
            } 

            $img_url = "$upload_url/photos/". $player['img'];

            return ' <div class="accordion-item shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button d-flex align-items-center py-3" type="button" 
                                    data-bs-toggle="collapse" data-bs-target="#'.$player["id"] .'" 
                                    aria-expanded="true" aria-controls="'.$player["id"] .'">
                                <div class="d-flex align-items-center w-100">
                                    <div class="position-relative me-3">
                                        <img src="'.$img_url.'" alt="'.$player["full_name"] .'" 
                                            class="rounded-circle img-fluid"
                                            style="width: 60px; height: 60px; object-fit: cover;">
                                        <span class="position-absolute bottom-0 end-0 badge bg-primary">#'.$player["j_num"] .'</span>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">'.$player["full_name"] .'</h5>
                                        <div class="text-muted small">
                                            <span class="badge bg-warning text-dark">'.$player["position"] .'</span>
                                            <span class="ms-2">DOB: '.$player["dob"] .'</span>
                                            <span class="badge '.$badge_color.' ms-2">'.$badge.'</span>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="'.$player["id"] .'" class="accordion-collapse collapse '.$is_show .'" 
                            data-bs-parent="#playersAccordion">
                            <div class="accordion-body pt-3">
                                <div class="row">
                                    <!-- Personal Info -->
                                    <div class="col-md-4 border-end">
                                        <h6 class="text-uppercase text-muted mb-3">
                                            <i class="bi bi-person-lines-fill me-2"></i>Details
                                        </h6>
                                        <ul class="list-unstyled">
                                            <li class="mb-2">
                                                <i class="bi bi-calendar me-2"></i>
                                                <strong>DOB:</strong> '.$player["dob"] .'
                                            </li>
                                            <li class="mb-2">
                                                <i class="bi bi-geo-alt me-2"></i>
                                                <strong>Origin:</strong> '.$player["state"] .'
                                            </li>
                                            <li class="mb-2">
                                                <i class="bi bi-rulers me-2"></i>
                                                <strong>Height:</strong> '.$player["height"] .'m
                                            </li>
                                            <li class="mb-2">
                                                <i class="bi bi-speedometer2 me-2"></i>
                                                <strong>Weight:</strong> '.$player["weight"] .'kg
                                            </li>
                                        </ul>
                                        
                                        <!-- Image Upload Button -->
                                        <button type="button" class="btn btn-sm btn-outline-primary mt-3" 
                                                data-bs-toggle="modal" data-bs-target="#imageModal'.$player['id'].'">
                                            <i class="bi bi-image me-1"></i> Add Image
                                        </button>
                                    </div>

                                    <!-- Performance Stats -->
                                    <div class="col-md-8">
                                        <h6 class="text-uppercase text-muted mb-3">
                                            <i class="bi bi-graph-up me-2"></i>2024 Season Stats
                                        </h6>
                                        <div class="table-responsive">
                                            <table class="table table-hover table-sm">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>Matches</th>
                                                        <th>Goals ⚽</th>
                                                        <th>Assists 🎯</th>
                                                        <th>Shots</th>
                                                        <th>Pass %</th>
                                                        <th>Rating ⭐</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>24</td>
                                                        <td>25</td>
                                                        <td>10</td>
                                                        <td>68</td>
                                                        <td>84%</td>
                                                        <td>8.9</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-end gap-2 mt-3">
                                    <a class="btn btn-outline-primary btn-sm" href="edit?id='. $player["id"] .'">
                                        <i class="bi bi-pencil me-2"></i>Edit Profile
                                    </a>
                                    <a class="btn ' . $btn_outline . ' btn-sm" 
                                        href="delete-player?id=' . htmlspecialchars($player['id']) .'">
                                            <i class="bi bi-person-x me-2"></i>' . htmlspecialchars($word) . '
                                    </a>                         
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Image Upload Modal -->
                    <div class="modal fade" id="imageModal'.$player['id'].'" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Update Player Image</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="text-center mb-3">
                                            <img src="'.$img_url.'" alt="Current Image" 
                                                class="img-fluid rounded mb-2" style="max-height: 200px;">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="player_image" class="form-label">Upload New Image</label>
                                            <input class="form-control" type="file" name="player_image" 
                                                name="player_image" accept="image/*">
                                            <div class="form-text">Max file size: 2MB (JPG, PNG)</div>
                                        </div>
                                        
                                        <input type="hidden" name="player_id" value="'.$player['id'].'">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary" name="img_btn">Upload Image</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>';
		}

        function transacDetailCard($transac){
            if ($transac['type'] == 0) {
                $color = 'text-danger';
                $icon = 'bi bi-arrow-down-circle-fill';
                $amount = '-&#8358;'.number_format($transac['amount']);
            }
            else {
                $color = 'text-success';
                $icon = 'bi bi-arrow-up-circle-fill';
                $amount = '+&#8358;'.number_format($transac['amount']);
            }

            return'<li class="list-group-item d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                        <i class="'.$icon.' '.$color.' fs-4 me-3"></i>
                        <div>
                            <strong>'.$transac['title'].'</strong><br>
                            <small class="text-muted">'.date('l, M j Y', strtotime($transac['created_at'])).'</small> 
                        </div>
                        </div>
                        <span class="'.$color.' fw-bold">'.$amount.'</span>
                    </li>';
        }

	}
?>