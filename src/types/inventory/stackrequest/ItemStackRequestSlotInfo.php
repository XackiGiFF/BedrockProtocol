<?php

/*
 * This file is part of BedrockProtocol.
 * Copyright (C) 2014-2022 PocketMine Team <https://github.com/pmmp/BedrockProtocol>
 *
 * BedrockProtocol is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace pocketmine\network\mcpe\protocol\types\inventory\stackrequest;

use pocketmine\network\mcpe\protocol\serializer\PacketSerializer;
use pocketmine\network\mcpe\protocol\types\inventory\ContainerUIIds;

final class ItemStackRequestSlotInfo{
	public function __construct(
		private int $containerId,
		private int $slotId,
		private int $stackId
	){}

	public function getContainerId() : int{ return $this->containerId; }

	public function getSlotId() : int{ return $this->slotId; }

	public function getStackId() : int{ return $this->stackId; }

	public static function read(PacketSerializer $in) : self{
		$containerId = ContainerUIIds::read($in);
		$slotId = $in->getByte();
		$stackId = $in->readGenericTypeNetworkId();
		return new self($containerId, $slotId, $stackId);
	}

	public function write(PacketSerializer $out) : void{
		ContainerUIIds::write($out, $this->containerId);
		$out->putByte($this->slotId);
		$out->writeGenericTypeNetworkId($this->stackId);
	}
}
