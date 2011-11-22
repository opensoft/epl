<?php
/*
* This file is part of ProFIT
*
* Copyright (c) 2011 Farheap Solutions (http://www.farheap.com)
*
* The unauthorized use of this code outside the boundaries of
* Farheap Solutions Inc. is prohibited.
*/
namespace Epl;
/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */

interface CommandInterface
{
public function toEplString();
}
