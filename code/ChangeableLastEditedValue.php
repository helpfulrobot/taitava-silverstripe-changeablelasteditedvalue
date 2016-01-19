<?php

/**
 * Class ChangeableLastEditedValueExtension
 * @property DataObject $owner
 */
class ChangeableLastEditedValueExtension extends Extension
{
	public function onBeforeWrite()
	{
		if (ChangeableLastEditedValue::config()->affect_last_edited)
		{
			$changed_fields = $this->owner->getChangedFields(true,2);
			if (isset($changed_fields['LastEdited']))
			{
				$this->owner->temp__ChangeableLastEditedValue = $this->owner->LastEdited;
			}
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

	public function onBeforePublish()
	{
		if (ChangeableLastEditedValue::config()->affect_publish_date)
		{
			$changed_fields = $this->owner->getChangedFields(true,2);
			if (isset($changed_fields['PublishDate']))
			{
				$this->owner->temp__ChangeablePublishDateValue = $this->owner->PublishDate;
			}
		}
	}

	public function onAfterPublish()
	{
		if (isset($this->owner->temp__ChangeablePublishDateValue))
		{
			$this->owner->LastEdited = $this->owner->temp__ChangeablePublishDateValue;
			unset($this->owner->temp__ChangeablePublishDateValue);
			$table_name = ClassInfo::baseDataClass($this->owner->ClassName); //Get the class name which holds the 'LastEdited' field. Might be for example 'SiteTree'.
			DB::query('UPDATE '.$table_name." SET PublishDate = '".Convert::raw2sql($this->owner->PublishDate)."'  WHERE ID = ".intval($this->owner->ID).' LIMIT 1');
		}
	}
}


class ChangeableLastEditedValue extends Object
{
	/**
	 * If true, this extension will ensure that $object->PublishDate stays the same after publishing the object, but
	 * only if it was specifically edited before
	 * @conf bool $AffectPublishDate
	 */
	private static $affect_publish_date	= false;

	private static $affect_last_edited	= true;
}