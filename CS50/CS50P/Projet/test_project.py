from unittest.mock import patch
from project import (
    create_champion,
    champion_level,
    number_items,
    equip_items,
    get_stats,
    combat,
)


def test_champion_level():
    with patch("builtins.input", side_effect=["abc", "18"]):
        assert champion_level() == 18


def test_number_items():
    with patch("builtins.input", side_effect=["abc", "3"]):
        assert number_items() == 3


def test_equip_items():
    assert equip_items(0) == []
    with patch("builtins.input", side_effect=["abc", "long sword"]):
        assert equip_items(1) == [{"name": "long sword", "ad": 10}]


def test_get_stats():
    assert get_stats(
        [
            {"name": "long sword", "ad": 10},
            {"name": "ruby cristal", "hp": 150},
            {"name": "cloth armor", "armor": 10},
        ]
    ) == (150, 10, 10)
    assert get_stats([]) == (0, 0, 0)
