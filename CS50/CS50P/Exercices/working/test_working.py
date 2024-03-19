import pytest
from working import convert

def test_format():
    with pytest.raises(ValueError):
        convert("9 to 5")
    with pytest.raises(ValueError):
        convert("9:00 to 5:00")
    with pytest.raises(ValueError):
        convert("nine AM to five PM")
    with pytest.raises(ValueError):
        convert("9 AM - 5 PM")
    with pytest.raises(ValueError):
        convert("9 AM 5 PM")
    with pytest.raises(ValueError):
        convert("9:00 AMto5:00 PM")


def test_values():
    assert convert("9 AM to 5 PM") == "09:00 to 17:00"
    assert convert("9 PM to 5 AM") == "21:00 to 05:00"
    with pytest.raises(ValueError):
        convert("14 PM to 19 PM")
    with pytest.raises(ValueError):
        convert("12:60 AM to 5:00 PM")

def test_exceptions():
    assert convert("12 AM to 12 PM") == "00:00 to 12:00"
    assert convert("10:30 PM to 8:50 AM") == "22:30 to 08:50"

