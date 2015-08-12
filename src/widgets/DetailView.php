<?php

namespace app\widgets;

use kartik\helpers\Html;
use yii\helpers\ArrayHelper;


/**
 * Class DetailView
 * @package app\widgets
 */
class DetailView extends \kartik\detail\DetailView
{
    /**
     * Renders a single attribute.
     *
     * @param array $attribute the specification of the attribute to be rendered.
     * @param int $index the zero-based index of the attribute in the [[attributes]] array
     *
     * @return string the rendering result
     */
    protected function renderAttribute($attribute, $index)
    {
        $rowOptions = ArrayHelper::getValue($attribute, 'rowOptions', $this->rowOptions);
        $labelColOptions = ArrayHelper::getValue($attribute, 'labelColOptions', $this->labelColOptions);
        $valueColOptions = ArrayHelper::getValue($attribute, 'valueColOptions', $this->valueColOptions);
        if (ArrayHelper::getValue($attribute, 'group', false) === true) {
            $groupOptions = ArrayHelper::getValue($attribute, 'groupOptions', []);
            $label = ArrayHelper::getValue($attribute, 'label', '');
            if (empty($groupOptions['colspan'])) {
                $groupOptions['colspan'] = 2;
            }
            return Html::tag('tr', Html::tag('th', $label, $groupOptions), $rowOptions);
        }
        if ($this->hideIfEmpty === true && empty($attribute['value'])) {
            return ''; // see https://github.com/kartik-v/yii2-detail-view/issues/17
            //Html::addCssClass($rowOptions, 'kv-view-hidden');
        }
        if (ArrayHelper::getValue($attribute, 'type', 'text') === self::INPUT_HIDDEN) {
            Html::addCssClass($rowOptions, 'kv-edit-hidden');
        }
        $dispAttr = $this->formatter->format($attribute['value'], $attribute['format']);
        Html::addCssClass($this->viewAttributeContainer, 'kv-attribute');
        Html::addCssClass($this->editAttributeContainer, 'kv-form-attribute');
        $output = Html::tag('div', $dispAttr, $this->viewAttributeContainer) . "\n";
        if ($this->enableEditMode) {
            $editInput = !empty($attribute['displayOnly']) && $attribute['displayOnly'] ?
                $dispAttr :
                $this->renderFormAttribute($attribute);
            $output .= Html::tag('div', $editInput, $this->editAttributeContainer);
        }
        return Html::beginTag('tr', $rowOptions) . "\n" .
        Html::beginTag('th', $labelColOptions) . $attribute['label'] . "</th>\n" .
        Html::beginTag('td', $valueColOptions) . $output . "</td>\n</tr>";
    }
}