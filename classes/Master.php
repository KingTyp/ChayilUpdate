<?php
require_once('../config.php');
class Master extends DBConnection
{
	private $settings;
	public function __construct()
	{
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct()
	{
		parent::__destruct();
	}
	function capture_err()
	{
		if (!$this->conn->error)
			return false;
		else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function save_department()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id'))) {
				if (!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if (!empty($data))
					$data .= ",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if (empty($id)) {
			$sql = "INSERT INTO `department_list` set {$data} ";
		} else {
			$sql = "UPDATE `department_list` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `department_list` where `name` = '{$name}' " . (is_numeric($id) && $id > 0 ? " and id != '{$id}'" : "") . " ")->num_rows;
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = 'Department Name already exists.';

		} else {
			$save = $this->conn->query($sql);
			if ($save) {
				$rid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['id'] = $rid;
				$resp['status'] = 'success';
				if (empty($id))
					$resp['msg'] = "Department has successfully added.";
				else
					$resp['msg'] = "Department details has been updated successfully.";
			} else {
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error . "[{$sql}]";
			}
		}
		if ($resp['status'] == 'success')
			$this->settings->set_flashdata('success', $resp['msg']);
		return json_encode($resp);
	}
	function delete_department()
	{
		extract($_POST);
		$del = $this->conn->query("UPDATE `department_list` set delete_flag = 1 where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Department has been deleted successfully.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_course()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id'))) {
				if (!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if (!empty($data))
					$data .= ",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if (empty($id)) {
			$sql = "INSERT INTO `course_list` set {$data} ";
		} else {
			$sql = "UPDATE `course_list` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `course_list` where `name` = '{$name}' and `department_id` = '{$department_id}' " . (is_numeric($id) && $id > 0 ? " and id != '{$id}'" : "") . " ")->num_rows;
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = ' Person In Charge already exists on the selected Department.';

		} else {
			$save = $this->conn->query($sql);
			if ($save) {
				$rid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['id'] = $rid;
				$resp['status'] = 'success';
				if (empty($id))
					$resp['msg'] = " Person In Charge has successfully added.";
				else
					$resp['msg'] = " Person In Charge details has been updated successfully.";
			} else {
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error . "[{$sql}]";
			}
		}
		if ($resp['status'] == 'success')
			$this->settings->set_flashdata('success', $resp['msg']);
		return json_encode($resp);
	}
	function delete_course()
	{
		extract($_POST);
		$del = $this->conn->query("UPDATE `course_list` set delete_flag = 1 where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Person In Charge  has been deleted successfully.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_student()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, ['id'])) {
				if (!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if (!empty($data))
					$data .= ",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if (empty($id)) {
			$sql = "INSERT INTO `student_list` set {$data} ";
		} else {
			$sql = "UPDATE `student_list` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `student_list` where roll = '{$roll}' " . (!empty($id) ? " and id != '{$id}' " : "") . " ")->num_rows;
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "An error occured.";
		} else {
			$save = $this->conn->query($sql);
			if ($save) {
				$sid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['sid'] = $sid;
				$resp['status'] = 'success';
				if (empty($id))
					$resp['msg'] = " Customer details successfully saved.";
				else
					$resp['msg'] = " Customer Information successfully updated.";
			} else {
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error . "[{$sql}]";
			}
		}
		if ($resp['status'] == 'success')
			$this->settings->set_flashdata('success', $resp['msg']);
		return json_encode($resp);
	}
	function delete_student()
	{
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `student_list` where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', " Customer has been deleted successfully.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_land()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, ['id'])) {
				if (!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if (!empty($data))
					$data .= ",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if (empty($id)) {
			$sql = "INSERT INTO `land` set {$data} ";
		} else {
			$sql = "UPDATE `land` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `land` where roll = '{$roll}' " . (!empty($id) ? " and id != '{$id}' " : "") . " ")->num_rows;
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "An error occured.";
		} else {
			$save = $this->conn->query($sql);
			if ($save) {
				$sid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['sid'] = $sid;
				$resp['status'] = 'success';
				if (empty($id))
					$resp['msg'] = " Land details successfully saved.";
				else
					$resp['msg'] = " Land Information successfully updated.";
			} else {
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error . "[{$sql}]";
			}
		}
		if ($resp['status'] == 'success')
			$this->settings->set_flashdata('success', $resp['msg']);


		return json_encode($resp);
	}

	function delete_land()
	{
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `land` where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', " Land Details have been deleted successfully.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_house()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, ['id'])) {
				if (!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if (!empty($data))
					$data .= ",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if (empty($id)) {
			$sql = "INSERT INTO `houses` set {$data} ";
		} else {
			$sql = "UPDATE `houses` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `houses` where roll = '{$roll}' " . (!empty($id) ? " and id != '{$id}' " : "") . " ")->num_rows;
		if ($check > 0) {
			$resp['status'] = 'failed';
			$resp['msg'] = "An error occured.";
		} else {
			$save = $this->conn->query($sql);
			if ($save) {
				$sid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['sid'] = $sid;
				$resp['status'] = 'success';
				if (empty($id))
					$resp['msg'] = " House details successfully saved.";
				else
					$resp['msg'] = " House Information successfully updated.";
			} else {
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error . "[{$sql}]";
			}
		}
		if ($resp['status'] == 'success')
			$this->settings->set_flashdata('success', $resp['msg']);
		return json_encode($resp);
	}
	function delete_house()
	{
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `houses` where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "  House Details have been deleted successfully.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_academic()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id'))) {
				if (!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if (!empty($data))
					$data .= ",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if (empty($id)) {
			$sql = "INSERT INTO `academic_history` set {$data} ";
		} else {
			$sql = "UPDATE `academic_history` set {$data} where id = '{$id}' ";
		}
		$save = $this->conn->query($sql);
		if ($save) {
			$resp['status'] = 'success';
			if (empty($id))
				$resp['msg'] = " Info has successfully added.";
			else
				$resp['msg'] = " Info details have been updated successfully.";
		} else {
			$resp['status'] = 'failed';
			$resp['msg'] = "An error occured.";
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
		if ($resp['status'] == 'success')
			$this->settings->set_flashdata('success', $resp['msg']);
		return json_encode($resp);
	}
	function delete_academic()
	{
		extract($_POST);
		$get = $this->conn->query("SELECT * FROM `academic_history` where id = '{$id}'");
		if ($get->num_rows > 0) {
			$res = $get->fetch_array();
		}
		$del = $this->conn->query("DELETE FROM `academic_history` where id = '{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', " Info has been deleted successfully.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function update_student_status()
	{
		extract($_POST);

		$update = $this->conn->query("UPDATE `student_list` set status = '{$status}' where id = '{$id}'");
		if ($update) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', " Customer's Status has been updated successfully.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function update_land_status()
	{
		extract($_POST);

		$update = $this->conn->query("UPDATE `land` set status = '{$status}' where id = '{$id}'");
		if ($update) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', " Land status has been updated successfully.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function update_house_status()
	{
		extract($_POST);

		$update = $this->conn->query("UPDATE `houses` set status = '{$status}' where id = '{$id}'");
		if ($update) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', " House status has been updated successfully.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

	function upload_Land_Details()
	{
		require_once('../conn.php');
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id'))) {
				if (!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if (!empty($data))
					$data .= ",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if (empty($id)) {
			$First_Name = $_POST['First_Name'];
			$Last_Name = $_POST['Last_Name'];
			$address = $_POST['address'];
			$roll = $_POST['roll'];
			$land_type = $_POST['land_type'];
			$dob = $_POST['dob'];
			$amount = $_POST['amount'];
			$land_owner_contact = $_POST['land_owner_contact'];
			$status = $_POST['status'];
			$details = $_POST['details'];

			$folder = "admin/uploads/";

			// Land Image Upload
			$land_file = $_FILES['land_image']['name'];
			$file = $_FILES['land_image']['tmp_name'];
			$target_file = $folder . basename($land_file);
			$file_name_array = explode(".", $land_file);
			$extension = end($file_name_array);
			$new_land_name = 'Photo_' . rand() . '.' . $extension;

			// Documents Upload
			$documents_file = $_FILES['documents']['name'];
			$Dfile = $_FILES['documents']['tmp_name'];
			$Dfolder = $folder . $documents_file;
			$Dtarget_file = $folder . basename($documents_file);
			$file_name_array = explode(".", $documents_file);
			$extension = end($file_name_array);
			$Dnew_documents_name = 'documents_' . rand() . '.' . $extension;

			if (!file_exists($folder)) {
				mkdir($folder, 0777, true);
			}

			if (move_uploaded_file($file, $folder . $new_land_name)) {
				if (move_uploaded_file($Dfile, $Dfolder . $Dnew_documents_name)) {
					$sql = "INSERT INTO land (First_Name, Last_Name, address, roll, land_type, dob, amount, land_owner_contact, status, details, land_image, documents) 
                        VALUES (:First_Name, :Last_Name, :address, :roll, :land_type, :dob, :amount, :land_owner_contact, :status, :details, :land_image, :documents)";

					$stmt = $conn->prepare($sql);

					$stmt->bindParam(':First_Name', $First_Name, PDO::PARAM_STR);
					$stmt->bindParam(':Last_Name', $Last_Name, PDO::PARAM_STR);
					$stmt->bindParam(':address', $address, PDO::PARAM_STR);
					$stmt->bindParam(':roll', $roll, PDO::PARAM_STR);
					$stmt->bindParam(':land_type', $land_type, PDO::PARAM_STR);
					$stmt->bindParam(':dob', $dob, PDO::PARAM_STR);
					$stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
					$stmt->bindParam(':land_owner_contact', $land_owner_contact, PDO::PARAM_STR);
					$stmt->bindParam(':status', $status, PDO::PARAM_STR);
					$stmt->bindParam(':details', $details, PDO::PARAM_STR);
					$stmt->bindParam(':land_image', $new_land_name, PDO::PARAM_STR);
					$stmt->bindParam(':documents', $Dnew_documents_name, PDO::PARAM_STR);

					if ($stmt->execute()) {
						$last_id = $conn->lastInsertId();
						if ($last_id != '') {
							header("location:../view_land.php?id=");
							exit();
						} else {
							echo 'Something went wrong';
						}
					} else {
						echo "Error: " . $stmt->errorInfo()[2];
					}
				} else {
					echo "Error uploading documents file.";
				}
			} else {
				echo "Error uploading land image file.";
			}
		}
	}




}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'save_department':
		echo $Master->save_department();
		break;
	case 'delete_department':
		echo $Master->delete_department();
		break;
	case 'save_course':
		echo $Master->save_course();
		break;
	case 'delete_course':
		echo $Master->delete_course();
		break;
	case 'save_student':
		echo $Master->save_student();
		break;
	case 'delete_student':
		echo $Master->delete_student();
		break;
	case 'save_land':
		echo $Master->save_land();
		break;
	case 'delete_land':
		echo $Master->delete_land();
		break;
	case 'save_house':
		echo $Master->save_house();
		break;
	case 'delete_house':
		echo $Master->delete_house();
	case 'save_academic':
		echo $Master->save_academic();
		break;
	case 'delete_academic':
		echo $Master->delete_academic();
		break;
	case 'update_student_status':
		echo $Master->update_student_status();
		break;
	case 'update_land_status':
		echo $Master->update_land_status();
		break;
	case 'update_house_status':
		echo $Master->update_house_status();
		break;
		case 'update_Land_Details':
			echo $Master->upload_Land_Details();
		break;
	default:
		// echo $sysset->index();
		break;
}