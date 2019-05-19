<?php
/**
 * Google Product Taxonomy plugin for Craft CMS 3.x
 *
 * Google Product Taxonomy Field
 *
 * @link      https://studioespresso.co/en
 * @copyright Copyright (c) 2019 Studio Espresso
 */

namespace studioespresso\googleproducttaxonomy\fields;

use studioespresso\googleproducttaxonomy\GoogleProductTaxonomy;
use studioespresso\googleproducttaxonomy\assetbundles\googleproducttaxonomyfieldfield\GoogleProductTaxonomyFieldFieldAsset;

use Craft;
use craft\base\ElementInterface;
use craft\base\Field;
use craft\helpers\Db;
use yii\db\Schema;
use craft\helpers\Json;

/**
 * GoogleProductTaxonomyField Field
 *
 * Whenever someone creates a new field in Craft, they must specify what
 * type of field it is. The system comes with a handful of field types baked in,
 * and we’ve made it extremely easy for plugins to add new ones.
 *
 * https://craftcms.com/docs/plugins/field-types
 *
 * @author    Studio Espresso
 * @package   GoogleProductTaxonomy
 * @since     1.0.0
 */
class GoogleProductTaxonomyField extends Field
{
    // Public Properties
    // =========================================================================

    /**
     * Some attribute
     *
     * @var string
     */
    public $taxonomyId = '';

    // Static Methods
    // =========================================================================

    /**
     * Returns the display name of this class.
     *
     * @return string The display name of this class.
     */
    public static function displayName(): string
    {
        return Craft::t('google-product-taxonomy', 'Google Product Taxonomy');
    }

    // Public Methods
    // =========================================================================

    /**
     * Returns the validation rules for attributes.
     *
     * Validation rules are used by [[validate()]] to check if attribute values are valid.
     * Child classes may override this method to declare different validation rules.
     *
     * More info: http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules = array_merge($rules, [
            ['taxonomyId', 'string'],
            ['taxonomyId', 'default', 'value' => 'Some Default'],
        ]);
        return $rules;
    }

    public function getContentColumnType(): string
    {
        return Schema::TYPE_STRING;
    }

    public function normalizeValue($value, ElementInterface $element = null)
    {
        return $value;
    }

    public function serializeValue($value, ElementInterface $element = null)
    {
        return parent::serializeValue($value, $element);
    }

    /**
     * Returns the component’s settings HTML.
     *
     * @return string|null
     */
    public function getSettingsHtml()
    {
        return null;
    }

    public function getInputHtml($value, ElementInterface $element = null): string
    {
        // Render the input template
        return Craft::$app->getView()->renderTemplate(
            'google-product-taxonomy/_input',
            [
                'name' => $this->handle,
                'value' => $value,
                'field' => $this,
                'id' => $id,
                'namespacedId' => $namespacedId,
            ]
        );
    }
}
