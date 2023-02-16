<?php
namespace backend\models;

use yii\imagine\Image;
use Imagine\Image\Box;

class UploadFilesForm extends \yii\base\Model
{
  /**
   * @var UploadedFile[]
   */
  public $files;
  public $thumbs;

  public function rules()
  {
      /*return [
          [['files'], 'file', 'maxFiles' => 15]
      ];*/
      return [
          ['files', 'image', 'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
              'checkExtensionByMimeType' => true,
              'maxSize' => 51200000, // 500 килобайт = 500 * 1024 байта = 512 000 байт
              'tooBig' => 'Limit is 500KB',
              'maxFiles' => 10
          ],
          ['thumbs', 'string'],
      ];
  }

  public function upload()
  {
    //echo "V = ".$this->validate()."\r\n";
    $dir = \Yii::getAlias('@uploadsTmpDir'); // Директория - должна быть создана

    if ($this->validate()) {
      foreach ($this->files as $file) {
        $name = $this->randomFileName($file->extension);
        $fileName = $dir.'/'.$name;
        $thumb = 'thumb_'.$name;
        $savePath = $dir.'/'.$thumb;
        $file->saveAs($fileName, $savePath);
        self::resize($fileName, $savePath);
        $this->thumbs[] = $thumb;
      }
      return true;
    } else {
      return false;
    }
  }

  private static function resize($openPath, $savePath)
  {
      $imagine = Image::getImagine();
      $imagine = $imagine->open($openPath);
      $sizes = getimagesize ($openPath);
      $width = 350;
      $height = round($sizes[1] * $width / $sizes[0]);
      $imagine = $imagine->resize(new Box($width, $height))->save($savePath, ['quality' => 70]);
  }

  private function randomFileName($extension = false)
  {
    $extension = $extension ? '.' . $extension : '';
    do {
      $name = md5(microtime() . rand(0, 1000));
      $file = $name . $extension;
    } while (file_exists($file));
    return $file;
  }
}