<?php

/**
 * EditFieldByModal View Class for OSSSoldServices
 * @package YetiForce.View
 * @license licenses/License.html
 * @author Radosław Skrzypczak <r.skrzypczak@yetiforce.com>
 */
class OSSSoldServices_EditFieldByModal_View extends Vtiger_EditFieldByModal_View
{

	protected $showFields = ['productname', 'ssservicesstatus','pscategory', 'datesold', 'dateinservice', 'parent_id', 'assigned_user_id', 'shownerid', 'serviceid'];

	function process(Vtiger_Request $request)
	{
		$moduleName = $request->getModule();
		$id = $request->get('record');
		
		$recordModel = Vtiger_DetailView_Model::getInstance($moduleName, $id)->getRecord();
		if($request->has('changeEditFieldByModal')){
			$recordModel->set('changeEditFieldByModal', $request->get('changeEditFieldByModal'));
		}
		$recordStrucure = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_DETAIL);
		$structuredValues = $recordStrucure->getStructure();

		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE_NAME', $moduleName);
		$viewer->assign('RECORD', $recordModel);
		$viewer->assign('SHOW_FIELDS', $this->getFieldsToShow());
		$viewer->assign('RECORD_STRUCTURE', $structuredValues);
		$viewer->assign('RESTRICTS_ITEM', $this->getRestrictItems());
		$this->preProcess($request);
		$viewer->view('EditFieldByModal.tpl', $moduleName);
		$this->postProcess($request);
	}
}
