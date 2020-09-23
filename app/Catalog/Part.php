<?php

declare(strict_types=1);

namespace App\Catalog;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Catalog\Part
 *
 * @property int $id
 * @property string|null $DataSupplierArticleNumber
 * @property int|null $Supplier
 * @property int|null $CurrentProduct
 * @property string|null $NormalizedDescription
 * @property int|null $HasLinkitems
 * @property int|null $HasPassengerCar
 * @property int|null $HasCommercialVehicle
 * @property int|null $HasMotorbike
 * @property int|null $HasEngine
 * @property int|null $HasAxle
 * @property int|null $HasCVManuID
 * @property int|null $LotSize1
 * @property int|null $LotSize2
 * @property int|null $FlagMaterialCertification
 * @property int|null $FlagSelfServicePacking
 * @property int|null $FlagRemanufactured
 * @property int|null $FlagAccessory
 * @property int|null $IsPseudoArticle
 * @property int|null $IsValid
 * @property string|null $Description
 * @property string|null $ArticleStateAttributeGroup
 * @property string|null $ArticleStateAttributeType
 * @property string|null $ArticleStateDisplayTitle
 * @property string|null $ArticleStateDisplayValue
 * @property int|null $PackingUnit
 * @property int|null $QuantityPerPackingUnit
 * @method static \Illuminate\Database\Eloquent\Builder|Part newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Part newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Part query()
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereArticleStateAttributeGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereArticleStateAttributeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereArticleStateDisplayTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereArticleStateDisplayValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereCurrentProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereDataSupplierArticleNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereFlagAccessory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereFlagMaterialCertification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereFlagRemanufactured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereFlagSelfServicePacking($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereHasAxle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereHasCVManuID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereHasCommercialVehicle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereHasEngine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereHasLinkitems($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereHasMotorbike($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereHasPassengerCar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereIsPseudoArticle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereIsValid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereLotSize1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereLotSize2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereNormalizedDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part wherePackingUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereQuantityPerPackingUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Part whereSupplier($value)
 * @mixin \Eloquent
 */
class Part extends Model
{
	/**
	 * The connection name for the model.
	 *
	 * @var string
	 */
	protected $connection = 'tecdoc';

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'articles';
}
