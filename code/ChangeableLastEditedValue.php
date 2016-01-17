<?php

/**
 * Class ChangeableLastEditedValueExtension
 * @property DataObject $owner
 */
class ChangeableLastEditedValueExtension extends Extension
{
	public function onBeforeWrite()
	{
		$changed_fields = $this->owner->getChangedFields(true,2);
		if (isset($changed_fields['LastEdited']))
		{
			$this->owner->temp__ChangeableLastEditedValue = $this->owner->LastEdited;
		}
	}

	public function onAfterWrite()
	{
		if (isset($this->owner->temp__ChangeableLastEditedValue))
		{
			$this->owner->LastEdited = $this->owner->temp__ChangeableLastEditedValue;
			unset($this->owner->temp__ChangeableLastEditedValue);
			$table_name = ClassInfo::baseDataClass($this->owner->ClassName); //Get the class name which holds the 'LastEdited' field. Might be for example 'SiteTree'.
			DB::query('UPDATE '.$table_name." SET LastEdited = '".Convert::raw2sql($this->owner->LastEdited)."'  WHERE ID = ".intval($this->owner->ID).' LIMIT 1');
		}
	}
}
