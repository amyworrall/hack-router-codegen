<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run vendor/phpunit/phpunit/phpunit
 *
 *
 * @generated SignedSource<<4acefab006582bb7ab2e1c57944e540a>>
 */
namespace Facebook\HackRouter\CodeGen\Tests\Generated;

final class MySiteRouter
  extends \Facebook\HackRouter\BaseRouter<classname<\Facebook\HackRouter\CodeGen\Tests\GetRequestExampleController>> {

  <<__Override>>
  final public function getRoutes(
  ): ImmMap<\Facebook\HackRouter\HttpMethod, ImmMap<string, classname<\Facebook\HackRouter\CodeGen\Tests\GetRequestExampleController>>> {
    $map = ImmMap {
      \Facebook\HackRouter\HttpMethod::GET => ImmMap {
        '/{MyString}/{MyInt:\\d+}/{MyEnum:(?:bar|derp)}' =>
          \Facebook\HackRouter\CodeGen\Tests\GetRequestExampleController::class,
      },
    };
    return $map;
  }
}
