from twttr import shorten

def test_lower():
    assert shorten("aeiou") == ""

def test_upper():
    assert shorten("AEIOU") == ""

def test_consonants():
    assert shorten("bcdfghjklmnpqrstv") == "bcdfghjklmnpqrstv"

def test_numbers():
    assert shorten("0123456789") == "0123456789"

def test_punctuation():
    assert shorten(".!?") == ".!?"
